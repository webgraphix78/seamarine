<?php

namespace App\Http\Controllers;

use App\Models\Imo5Condition;
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

class Imo5ConditionController extends Controller
{

	//
	public function index()
	{
		$component = 'imo5-component';
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

	public function add()
	{
		$component = "imo5-add-component";
		$param1 = "";
		if( isset($_GET["mode"]) && strlen(trim($_GET["mode"])) > 0 ){
			$param1 = $_GET["mode"];
		}
		return view('common.index', compact("component", "param1"));
	}

	public function edit($imo5Id)
	{
		$component = "imo5-add-component";
		$objectId = $imo5Id;
		$object = \App\Models\Imo5Condition::find($objectId);
		if ($object == null)
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}

	public function view($imo5Id)
	{
		$component = "imo5-view-component";
		$objectId = $imo5Id;
		if (\App\Models\Imo5Condition::find($objectId) == null)
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}

	public function getRecord($imo5Id){
		$imoRecord = \App\Models\Imo5Condition::with('tank_type', 'tcode', 'inspection_location', 'cleaning_location', 'customer', 'creator')->find($imo5Id);
		return $imoRecord->toJson();
	}

	public function get(Request $request)
	{
		$input = $request->all();
		$imo5conditionList = \App\Models\Imo5Condition::with('tank_type', 'tcode', 'inspection_location', 'cleaning_location', 'customer', 'creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$imo5conditionList = $imo5conditionList->where(function ($query) use ($input) {
					$query = $query->where('container_no', 'like', '%' . strtoupper(trim($input['q'])) . '%')
						->orWhere('refno', 'like', '%' . strtoupper(trim($input['q'])) . '%');
				});
				$imo5conditionList = $imo5conditionList->orWhereHas('customer', function ($query) use ($input) {
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
								$imo5conditionList = $imo5conditionList->whereNot(function ($query) use ($filter) {
									$query = $query->where('container_no', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$imo5conditionList = $imo5conditionList->where(function ($query) use ($filter) {
									$query = $query->where('container_no', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$imo5conditionList = $imo5conditionList->where(function ($query) use ($filter) {
									$query = $query->where('container_no', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$imo5conditionList = $imo5conditionList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$imo5conditionList = $imo5conditionList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$imo5conditionList = $imo5conditionList->where('status', 1);
		}
		// Role condition - customer
		$user = \App\Models\User::find($input['current_user_id']);
		if ($user->role_id == 2) {
			// Wait
			$imo5conditionList = $imo5conditionList->where('customer_id', $user->customer_id)->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$imo5conditionList = $imo5conditionList->orderByDesc(trim($input["sortBy"]));
			else
				$imo5conditionList = $imo5conditionList->orderBy(trim($input["sortBy"]));
		}
		else{
			$imo5conditionList = $imo5conditionList->orderByDesc("created_at");
		}
		if (isset($input["page"]))
			$imo5conditionList = $imo5conditionList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\Imo5ConditionExport($imo5conditionList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'Imo5ConditionList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'Imo5ConditionList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'Imo5ConditionList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'Imo5ConditionList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'Imo5ConditionList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$imo5conditionList = $imo5conditionList->get();
		}
		return \App\Http\Resources\Imo5ConditionResource::collection($imo5conditionList);
	}

	public function verifyTankNumber(Request $request){
		$input = $request->all();
		if (isset($input["tankNo"]) && strlen(trim($input["tankNo"])) > 0) {
			$tankNoStatus = TankContainerService::validateTankContainerNumber(trim($input["tankNo"]));
			if( $tankNoStatus == 1 ){
				// Check the last 3 entries
				$lastThree = \App\Models\Imo5Condition::where('container_no', trim($input["tankNo"]))
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

	// Duplicate the record - not needed for this
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\Imo5Condition::find($objectId)->replicate(['refno']);
			$duplicateObject->save();
			$duplicateObject->refno = $duplicateObject->id;//"C".str_pad($duplicateObject->id, 6, "0", STR_PAD_LEFT);
			$duplicateObject->created_by = Auth::id();
			$duplicateObject->save();
			return response()->json(["status" => 1, "id" => $duplicateObject->id]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Could not duplicate record."]]);
		}
	} 

	// Save imo5condition
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["imo5condition"])) {
			$imo5condition = $input["imo5condition"];
			$objectToSave = [];
			$checkTitle = true;
			if ($imo5condition["action"] == "status") {
				$objectToSave["status"] = $imo5condition["status"];
			}
			if ($imo5condition["action"] == "details") {
				$rules = [
					'container_no' => ['required','string'],
					'customer_id' => 'required',
				];
				$validator = Validator::make($imo5condition, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $imo5condition;
				if ($imo5condition["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
			}
			$imo5ConditionObject = \App\Models\Imo5Condition::updateOrCreate(["id" => $imo5condition["id"]], $objectToSave);
			if( $imo5condition["id"] == 0 ){
				// If this is a new object
				$imo5ConditionObject->refno = $imo5ConditionObject->id;
				// Also check if the user is a surveyor, set the status to 0
				$user = \App\Models\User::find(Auth::id());
				if( $user->role_id == 4 ){
					$imo5ConditionObject->status = 0;
				}
				$imo5ConditionObject->save();
			}
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for IMO 5 Condition is missing."]]);
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
			\App\Models\Imo5Condition::find($objectId)->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}

	// Export to PDF
	public function exportToPDF($imo5ConditionId, Request $request){
		$imo5Condition = \App\Models\Imo5Condition::with('tank_type', 'tcode', 'inspection_location', 'cleaning_location', 'customer', 'creator')->find($imo5ConditionId);
		$company = \App\Models\Company::find(1);
		$filename = $imo5Condition->container_no.".pdf";
		$data = [
			'imo5Condition' => $imo5Condition,
		];
		if( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ){
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$company["signature_url"]);
			$signImage = 'data:image/'.strtoupper($signPathInfo['extension']).';base64,'.base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			if (file_exists(public_path('images/imo5diagram.png'))) {
				$data['imo5diagram'] = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/imo5diagram.png')));
			}

			$view = View::make('pdfs.imo5condition', $data);
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
			$pdf->SetTitle($imo5Condition->container_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight)+8);
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $imo5Condition->id)->where('object_name', "IMO5Condition")->get();
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
					// $pdf->AddPage(($imageWidth > $imageHeight ? 'L' : 'P'), array($imageWidthMM, $imageHeightMM));
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
