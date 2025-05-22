<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\TankContainerService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class CleaningController extends Controller
{

	//
	public function index()
	{
		$component = 'cleaning-component';
		$current_user_id = auth()->id();

		switch(auth()->user()->role_id){
			case 2:
				$all_permissions = "100";
				break;
			case 1:
			case 3:
			case 4:
				$all_permissions = "111";
				break;
			default:
				abort(403);
		}

		$mode = "";
		if( isset($_GET["mode"]) && strlen(trim($_GET["mode"])) > 0 ){
			$mode = $_GET["mode"];
		}
		log::info("mode :: ".$mode);
		return view('common.index', compact('component', 'current_user_id', 'all_permissions', 'mode'));
	}

	public function get(Request $request)
	{
		$input = $request->all();
		$cleaningList = \App\Models\Cleaning::with('company', 'tank', 'tcode', 'customer','client', 'inspectionlocation', 'cleaninglocation', 'surveyor', 'creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$cleaningList = $cleaningList->where(function ($query) use ($input) {
					$query = $query->where('ref_no', 'like', '%' . strtoupper(trim($input['q'])) . '%')
						->orWhere('tank_no', 'like', '%' . strtoupper(trim($input['q'])) . '%');
				});
				$cleaningList = $cleaningList->orWhereHas('customer', function ($query) use ($input) {
					$query = $query->where('name', 'like', '%' . trim($input['q']) . '%');
				});
			}
		} else {
			// Advanced search
			if (isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0) {
				foreach ($input['advfilters'] as $filter) {
					if ($filter['property'] == "__q") {
						switch ($filter['condition']) {
							case 0: // NOT EQUALS
								$cleaningList = $cleaningList->whereNot(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))
										->orWhere('tank_no', trim($filter['search_for_value']))->orWhere('customer_id', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$cleaningList = $cleaningList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))
										->orWhere('tank_no', trim($filter['search_for_value']))->orWhere('customer_id', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$cleaningList = $cleaningList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')
										->orWhere('tank_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('customer_id', 'like', '%' . trim($filter['search_for_value']) . '%');
								});
								break;
						}
					} else {
						$condition = '=';
						$searchType = 'direct';
						switch ($filter['condition']) {
							case 0:
								$condition = "!=";
								break;
							case 2:
							case 12:
								$condition = "<=";
								break;
							case 3:
							case 13:
								$condition = ">=";
								break;
							case 5:
							case 15:
								$searchType = 'between';
								break;
						}
						if ($searchType == 'direct') {
							$cleaningList = $cleaningList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$cleaningList = $cleaningList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$cleaningList = $cleaningList->where('status', 1);
		}
		// Role condition - customer
		$user = \App\Models\User::find($input['current_user_id']);
		if ($user->role_id == 2) {
			// Wait
			$cleaningList = $cleaningList->where('customer_id', $user->customer_id)->where('status', 1);
		}
		else if ($user->role_id == 4) {
			$cleaningList = $cleaningList->where('created_by', $user->id);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$cleaningList = $cleaningList->orderByDesc(trim($input["sortBy"]));
			else
				$cleaningList = $cleaningList->orderBy(trim($input["sortBy"]));
		}
		else{
			$cleaningList = $cleaningList->orderByDesc("created_at");
		}
		if (isset($input["page"]))
			$cleaningList = $cleaningList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\CleaningExport($cleaningList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'CleaningList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'CleaningList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'CleaningList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'CleaningList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'CleaningList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} 
			else
				$cleaningList = $cleaningList->paginate(10);
		}
		return \App\Http\Resources\CleaningResource::collection($cleaningList);
	}

	public function verifyTankNumber(Request $request){
		$input = $request->all();
		if (isset($input["tankNo"]) && strlen(trim($input["tankNo"])) > 0) {
			$tankNoStatus = TankContainerService::validateTankContainerNumber(trim($input["tankNo"]));
			if( $tankNoStatus == 1 ){
				// Check the last 3 entries
				$lastThree = \App\Models\Cleaning::where('tank_no', trim($input["tankNo"]))
					->orderBy('created_at', 'desc')
					->distinct()
					->pluck('created_at')
					->unique()
					->take(3)
					->map(function ($date) {
						return \Carbon\Carbon::parse($date)->format('M d, Y');
					});
				return response()->json(["status" => 1, "lastthree" => $lastThree, "message" => ""]);
			}
			else{
				return response()->json(["status" => -1, "message" => "Invalid Tank/Container number. Please check."]);
			}
		} else {
			return response()->json(["status" => -200, "message" => "Tank/Container Number is missing."]);
		}
	}

	// Save cleaning
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["cleaning"])) {
			$cleaning = $input["cleaning"];
			$objectToSave = [];
			if ($cleaning["action"] == "status") {
				$objectToSave["status"] = $cleaning["status"];
			}
			else if ($cleaning["action"] == "details") {
				$rules = [
					'company_id' => 'required',
					'tank_type_id' => 'required',
					'tank_no' => ['required','string'],
					'tcode_id' => 'required',
					'customer_id' => 'required',
					'inspection_locn' => 'required',
					'client_id' => 'required',
					'surveyor_id' => 'required',
					'frame_tank' => 'required',
					'manlid_valves' => 'required',
					'serial_nos' => 'required',
					'labels_removed' => 'required',
					'entry' => 'required',
					'odour_free' => 'required',
					'clean_free' => 'required',
					'corrosion_free' => 'required',
					'dry' => 'required',
					'valves' => 'required',
					'manlid_seal' => 'required',
					'gas_free' => 'required',
					'siphon' => 'required',
				];
				$validator = Validator::make($cleaning, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $cleaning;
				if ($cleaning["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
				
				// New setting for dt_inspection_date
				if( isset($objectToSave["inspection_date"]) && strlen($objectToSave["inspection_date"]) > 0 ){
					$objectToSave["dt_inspection_date"] = date("Y-m-d", strtotime($objectToSave["inspection_date"]));
				}
			}
			$cleaningObject = \App\Models\Cleaning::updateOrCreate(["id" => $cleaning["id"]], $objectToSave);
			if( $cleaning["id"] == 0 ){
				// If this is a new object
				$cleaningObject->ref_no = "CC".str_pad($cleaningObject->id, 6, "0", STR_PAD_LEFT);
				// Also check if the user is a surveyor, set the status to 0
				$user = \App\Models\User::find(Auth::id());
				if( $user->role_id == 4 ){
					$cleaningObject->status = 0;
				}
				$cleaningObject->save();
			}
			// If the action was status, then we need to send the email to the client
			if ($cleaning["action"] == "status"){
				if( $cleaning["status"] == 1 ){
					try{
						// Get the client email
						$customer = \App\Models\Customer::find($cleaning["customer_id"]);
						log::info("customer_id :: ".$cleaning["customer_id"]);
						if( $customer ){
							$customerEmail = $customer->email;
							log::info("customerEmail :: ".$customerEmail);
							if( strlen($customerEmail) > 0 ){
								$dataArray = [
									"tank_number" => $cleaningObject->tank_no,
									"report_date" => $cleaningObject->inspection_date,
									"survey_type" => "Cleaning",
									"inspection_location" => $cleaningObject->inspectionlocation->name,
									"surveyor" => $cleaningObject->surveyor->name,
								];
								log::info(json_encode($dataArray));
								// Send the email
								MailService::notifyClientForCleaningReport($customerEmail, $dataArray);
							}
							else{
								return response()->json(["status" => 100, "messages" => ["Record has been activated but client could not be notified."]]);
							}
						}
					}
					catch(\Throwable $th){
						// Log the error
						Log::error("Error sending email: ".$th->getMessage());
						return response()->json(["status" => 100, "messages" => ["Record has been activated but client could not be notified."]]);
					}
				}
			}
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Cleaning is missing."]]);
		}
	}

	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			$allMedia = \App\Models\Media::where('object_id', $objectId)->get();
			foreach($allMedia as $mediaObject){
				$filePath = $mediaObject->url;
				if( strlen($filePath) > 0 && Storage::exists($filePath) ){
					Storage::delete($filePath);
					$mediaObject->delete();
				}
			}
			\App\Models\Cleaning::find($objectId)->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}

	// Duplicate the record - not needed for this
	// public function duplicateRecord(Request $request){
	// 	$input = $request->all();
	// 	if (isset($input["cleaning"])) {
	// 		$object = $input["cleaning"];
	// 		$duplicateObject = \App\Models\Cleaning::find($object["id"])->replicate(['ref_no']);
	// 		$duplicateObject->save();
	// 		$duplicateObject->ref_no = "CC".str_pad($duplicateObject->id, 6, "0", STR_PAD_LEFT);
	// 		$duplicateObject->created_by = Auth::id();
	// 		$duplicateObject->save();
	// 		return response()->json(["status" => 1, "id" => $duplicateObject->id]);
	// 	}
	// 	else{
	// 		return response()->json(["status" => -1, "messages" => ["Could not duplicate record."]]);
	// 	}
	// } 

	public function exportToPDF($cleaningId, Request $request){
		$cleaning = \App\Models\Cleaning::with('company', 'tank', 'tcode', 'customer', 'client', 'inspectionlocation', 'cleaninglocation', 'surveyor', 'creator')->find($cleaningId);
		$company = $cleaning["company"];
		$filename = $cleaning->tank_no.".pdf";
		$data = [
			'cleaning' => $cleaning,
		];
		if( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ){
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$company["signature_url"]);
			$signImage = 'data:image/'.strtoupper($signPathInfo['extension']).';base64,'.base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.cleaning', $data);
			$html = $view->render();
			$pdf = new \App\Models\BotPDF;
			$pdf->headerImage = $company["header_url"];
			// set default header data
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "", "");
			// set margins
			// $pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT, true);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->SetTitle($cleaning->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $cleaning->id)->where('object_name', "Cleaning")->get();
			if( count($images) > 0 ){
				$pdf->SetMargins(0, 0, 0, true);
				// Remove header and footer
				$pdf->setPrintHeader(false);
				$pdf->setPrintFooter(false);
				foreach ($images as $image) {
					$imageAbsolutePath = storage_path("app" . DIRECTORY_SEPARATOR . $image['url']);
					list($imageWidth, $imageHeight) = getimagesize($imageAbsolutePath);
					
    				// Convert image dimensions to millimeters (assuming 96 DPI)
					$dpi = 96;
					$imageWidthMM = $imageWidth * 25.4 / $dpi;
					$imageHeightMM = $imageHeight * 25.4 / $dpi;

					$pdf->AddPage(($imageWidth > $imageHeight ? 'L' : 'P'), 'A4');//array($imageWidthMM, $imageHeightMM));
					$pageWidth = $pdf->getPageWidth();
					$pageHeight = $pdf->getPageHeight();
					$pdf->Image(
						$imageAbsolutePath, 
						0, 0, $pageWidth, $pageHeight,
						'', '', '', true, 300, '', false, false, 0, 'LT', false, false);
				}
			}
			$pdf->Output($filename, 'D');
		}
	}
}
