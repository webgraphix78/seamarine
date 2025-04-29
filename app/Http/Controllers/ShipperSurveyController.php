<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\PlatformObject;
use App\Services\TankContainerService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class ShipperSurveyController extends Controller
{

	//
	public function index()
	{
		$component = 'shippersurvey-component';
		$current_user_id = auth()->id();

		switch(auth()->user()->role_id){
			case 2:
				$all_permissions = "100";
				break;
			case 1:
			case 3:
				$all_permissions = "111";
				break;
			default:
				abort(403);
		}
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request)
	{
		$input = $request->all();
		$shippersurveyList = \App\Models\ShipperSurvey::with('company', 'surveyor', 'for_shipper', 'customer', 'inspection_location', 'creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$shippersurveyList = $shippersurveyList->where(function ($query) use ($input) {
					$query = $query->where('ref_no', 'like', '%' . strtoupper(trim($input['q'])) . '%')
						->orWhere('tank_container_no', 'like', '%' . strtoupper(trim($input['q'])) . '%');
				});
				$shippersurveyList = $shippersurveyList->orWhereHas('customer', function ($query) use ($input) {
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
								$shippersurveyList = $shippersurveyList->whereNot(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))
										->orWhere('company_id', trim($filter['search_for_value']))->orWhere('tank_container_no', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$shippersurveyList = $shippersurveyList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))
										->orWhere('company_id', trim($filter['search_for_value']))->orWhere('tank_container_no', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$shippersurveyList = $shippersurveyList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')
										->orWhere('company_id', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('tank_container_no', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$shippersurveyList = $shippersurveyList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$shippersurveyList = $shippersurveyList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$shippersurveyList = $shippersurveyList->where('status', 1);
		}
		// Role condition - customer
		$user = \App\Models\User::find($input['current_user_id']);
		if ($user->role_id == 2) {
			$shippersurveyList = $shippersurveyList->where('customer_id', $user->customer_id)->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$shippersurveyList = $shippersurveyList->orderByDesc(trim($input["sortBy"]));
			else
				$shippersurveyList = $shippersurveyList->orderBy(trim($input["sortBy"]));
		}
		else{
			$shippersurveyList = $shippersurveyList->orderByDesc("created_at");
		}
		if (isset($input["page"]))
			$shippersurveyList = $shippersurveyList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\ShipperSurveyExport($shippersurveyList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'ShipperSurveyList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'ShipperSurveyList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'ShipperSurveyList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'ShipperSurveyList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'ShipperSurveyList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$shippersurveyList = $shippersurveyList->get();
		}
		return \App\Http\Resources\ShipperSurveyResource::collection($shippersurveyList);
	}

	public function verifyTankNumber(Request $request){
		$input = $request->all();
		if (isset($input["tankNo"]) && strlen(trim($input["tankNo"])) > 0) {
			$tankNoStatus = TankContainerService::validateTankContainerNumber(trim($input["tankNo"]));
			if( $tankNoStatus == 1 ){
				// Check the last 3 entries
				$lastThree = \App\Models\ShipperSurvey::where('tank_container_no', trim($input["tankNo"]))
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
			return response()->json(["status" => -200, "messages" => ["Tank/Container Number is missing."]]);
		}
	}

	// Save shippersurvey
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["shippersurvey"])) {
			$shippersurvey = $input["shippersurvey"];
			$objectToSave = [];
			$checkTitle = true;
			if ($shippersurvey["action"] == "status") {
				$objectToSave["status"] = $shippersurvey["status"];
				if ($shippersurvey["status"] <= 0)
					$checkTitle = false;
			}
			if ($shippersurvey["action"] == "details") {
				$rules = [
					'company_id' => 'required',
					'tank_container_no' => ['required','string'],
				];
				$validator = Validator::make($shippersurvey, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $shippersurvey;
				if ($shippersurvey["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
				// New setting for dt_inspection_date
				if( isset($objectToSave["survey_date"]) && strlen($objectToSave["survey_date"]) > 0 ){
					$objectToSave["dt_inspection_date"] = date("Y-m-d", strtotime($objectToSave["survey_date"]));
				}
			}
			$shippersurveyObject = \App\Models\ShipperSurvey::updateOrCreate(["id" => $shippersurvey["id"]], $objectToSave);
			if( $shippersurvey["id"] == 0 ){
				// If this is a new object
				$shippersurveyObject->ref_no = "S".str_pad($shippersurveyObject->id, 6, "0", STR_PAD_LEFT);
				// Also check if the user is a surveyor, set the status to 0
				$user = \App\Models\User::find(Auth::id());
				if( $user->role_id == 4 ){
					$shippersurveyObject->status = 0;
				}
				$shippersurveyObject->save();
			}
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Shipper Survey is missing."]]);
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
			\App\Models\ShipperSurvey::find($objectId)->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}

	// Export to PDF
	public function exportToPDF($shipperSurveyId, Request $request){
		$shipperSurvey = \App\Models\ShipperSurvey::with('company', 'surveyor', 'for_shipper', 'customer', 'inspection_location', 'creator')->find($shipperSurveyId);
		$company = \App\Models\Company::find(1);
		$filename = $shipperSurvey->tank_container_no.".pdf";
		$data = [
			'shipperSurvey' => $shipperSurvey,
		];
		if( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ){
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$company["signature_url"]);
			$signImage = 'data:image/'.strtoupper($signPathInfo['extension']).';base64,'.base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.shippersurvey', $data);
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
			$pdf->SetTitle($shipperSurvey->tank_container_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight)+2);
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $shipperSurvey->id)->where('object_name', "ShipperSurvey")->get();
			if( count($images) > 0 ){
				$pdf->SetMargins(0, 0, 0);
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

					// $pdf->AddPage(($imageWidth > $imageHeight ? 'L' : 'P'), array($imageWidthMM, $imageHeightMM));
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
