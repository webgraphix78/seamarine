<?php

namespace App\Http\Controllers;

use App\Models\Drybox;
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
use Illuminate\Support\Facades\View as View;
use Illuminate\Validation\Rule;

class DryboxController extends Controller
{

	//
	public function index()
	{
		$component = 'drybox-component';
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
		$dryboxList = \App\Models\Drybox::with('company', 'inspectionlocation', 'customer', 'surveyor', 'creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$dryboxList = $dryboxList->where(function ($query) use ($input) {
					$query = $query->where('ref', 'like', '%' . strtoupper(trim($input['q'])) . '%')
						->orWhere('container_no', 'like', '%' . strtoupper(trim($input['q'])) . '%');
				});
				$dryboxList = $dryboxList->orWhereHas('customer', function ($query) use ($input) {
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
								$dryboxList = $dryboxList->whereNot(function ($query) use ($filter) {
									$query = $query->where('inspection_location_id', trim($filter['search_for_value']))->orWhere('customer_id', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$dryboxList = $dryboxList->where(function ($query) use ($filter) {
									$query = $query->where('inspection_location_id', trim($filter['search_for_value']))->orWhere('customer_id', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$dryboxList = $dryboxList->where(function ($query) use ($filter) {
									$query = $query->where('inspection_location_id', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('customer_id', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$dryboxList = $dryboxList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$dryboxList = $dryboxList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$dryboxList = $dryboxList->where('status', 1);
		}
		// Role condition - customer
		$user = \App\Models\User::find($input['current_user_id']);
		if ($user->role_id == 2) {
			// Wait
			$dryboxList = $dryboxList->where('customer_id', $user->customer_id)->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$dryboxList = $dryboxList->orderByDesc(trim($input["sortBy"]));
			else
				$dryboxList = $dryboxList->orderBy(trim($input["sortBy"]));
		}
		else{
			$dryboxList = $dryboxList->orderByDesc("created_at");
		}
		if (isset($input["page"]))
			$dryboxList = $dryboxList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\DryboxExport($dryboxList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'DryboxList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'DryboxList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'DryboxList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'DryboxList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'DryboxList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$dryboxList = $dryboxList->get();
		}
		return \App\Http\Resources\DryboxResource::collection($dryboxList);
	}

	public function verifyTankNumber(Request $request){
		$input = $request->all();
		if (isset($input["tankNo"]) && strlen(trim($input["tankNo"])) > 0) {
			$tankNoStatus = TankContainerService::validateTankContainerNumber(trim($input["tankNo"]));
			if( $tankNoStatus == 1 ){
				// Check the last 3 entries
				$lastThree = \App\Models\Drybox::where('container_no', trim($input["tankNo"]))
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
	
	// Save drybox
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["drybox"])) {
			$drybox = $input["drybox"];
			$objectToSave = [];
			if ($drybox["action"] == "status") {
				$objectToSave["status"] = $drybox["status"];
				if ($drybox["status"] <= 0)
					$checkTitle = false;
			}
			if ($drybox["action"] == "details") {
				$rules = [
					'container_no' => ['required','string'],
					'company_id' => 'required',
					'inspection_location_id' => 'required',
					'customer_id' => 'required',
					'surveyor_id' => 'required',
				];
				$validator = Validator::make($drybox, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $drybox;
				if ($drybox["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
				
				// New setting for dt_inspection_date
				if( isset($objectToSave["inspection_date"]) && strlen($objectToSave["inspection_date"]) > 0 ){
					$objectToSave["dt_inspection_date"] = date("Y-m-d", strtotime($objectToSave["inspection_date"]));
				}
			}
			$dryboxObject = \App\Models\Drybox::updateOrCreate(["id" => $drybox["id"]], $objectToSave);
			if( $drybox["id"] == 0 ){
				// If this is a new object
				$dryboxObject->ref = "D".str_pad($dryboxObject->id, 6, "0", STR_PAD_LEFT);
				// Also check if the user is a surveyor, set the status to 0
				$user = \App\Models\User::find(Auth::id());
				if( $user->role_id == 4 ){
					$dryboxObject->status = 0;
				}
				$dryboxObject->save();
			}
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Drybox is missing."]]);
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

	// Export to PDF
	public function exportToPDF($dryboxId, Request $request)
	{
		$drybox = \App\Models\Drybox::with('company', 'customer', 'inspectionlocation', 'surveyor', 'creator')->find($dryboxId);
		$company = $drybox["company"];
		$filename = $drybox->container_no . ".pdf";
		$data = [
			'drybox' => $drybox,
		];
		if (strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"])) {
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app" . DIRECTORY_SEPARATOR . $company["signature_url"]);
			$signImage = 'data:image/' . strtoupper($signPathInfo['extension']) . ';base64,' . base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$containerImage = '';
			if (file_exists(public_path('images/container.png'))) {
				$containerImage = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/container.png')));
				$data['container'] = $containerImage;
			}
			$view = View::make('pdfs.drybox', $data);
			$html = $view->render();
			$pdf = new \App\Models\BotPDF;
			$pdf->headerImage = $company["header_url"];
			// set default header data
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(1);
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "", "");
			// set margins
			// $pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT, true);
			$pdf->SetAutoPageBreak(TRUE, 1);
			$pdf->SetTitle($filename);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $drybox->id)->where('object_name', "Drybox")->get();
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
