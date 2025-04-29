<?php

namespace App\Http\Controllers;

use App\Models\Imo1;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\PlatformObject;
use App\Services\TankContainerService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class Imo1Controller extends Controller
{

	//
	public function index()
	{
		$component = 'imo1-component';
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
		$component = "imo1-add-component";
		return view('common.index', compact("component"));
	}

	public function edit($imo1Id)
	{
		$component = "imo1-add-component";
		$objectId = $imo1Id;
		$object = \App\Models\Imo1::find($objectId);
		if( $object == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}

	public function view($imo1Id)
	{
		$component = "imo1-view-component";
		$objectId = $imo1Id;
		if( \App\Models\Imo1::find($objectId) == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}

	public function getRecord($imo1Id){
		$imoRecord = \App\Models\Imo1::with('company', 'tanktype', 'tcode', 'for_client_rec', 'surveyor', 'inspection_location', 'customer', 'ladder_cond_status', 'document_box_cond_status', 'temperature_gauge_cond_status', 'steam_cond_status', 'steam_pressure_cond_status', 'remote_system_cond_status', 'electrical_heating_cond_status', 'manlid_cond_status', 'manlid_swing_cond_status', 'insp_hatch_cond_status', 'insp_hatch_swing_bolt_cond_status', 'spill_box_cond_status', 'pre_valve_cond_status', 'pre_bursting_disc_cond_status', 'walkyway_ls_cond_status', 'walkyway_scs_cond_status', 'walkyway_mls_cond_status', 'airline_valve_cond_status', 'tank_gauge_cond_status', 'dipstick_cond_status', 'calibration_chart_cond_status', 'syphon_pipe_cond_status', 'bfly_valve_cond_status', 'blank_flange_cond_status', 'top_vapour_cond_status', 'top_vapour_bolts_cond_status', 'flanged_provision_cond_status', 'bottom_foot_cond_status', 'bottom_bfly_cond_status', 'bottom_outlet_flange_cond_status', 'bottom_valve_handle_cond_status', 'bottom_bfly_ball_cond_status', 'fusible_link_cond_status', 'creator')->find($imo1Id);
		return $imoRecord->toJson();
	}

	public function get(Request $request)
	{
		$input = $request->all();
		$imo1List = \App\Models\Imo1::with('company', 'tanktype', 'tcode', 'for_client_rec', 'surveyor', 'inspection_location', 'customer', 'ladder_cond_status', 'document_box_cond_status', 'temperature_gauge_cond_status', 'steam_cond_status', 'steam_pressure_cond_status', 'remote_system_cond_status', 'electrical_heating_cond_status', 'manlid_cond_status', 'manlid_swing_cond_status', 'insp_hatch_cond_status', 'insp_hatch_swing_bolt_cond_status', 'spill_box_cond_status', 'pre_valve_cond_status', 'pre_bursting_disc_cond_status', 'walkyway_ls_cond_status', 'walkyway_scs_cond_status', 'walkyway_mls_cond_status', 'airline_valve_cond_status', 'tank_gauge_cond_status', 'dipstick_cond_status', 'calibration_chart_cond_status', 'syphon_pipe_cond_status', 'bfly_valve_cond_status', 'blank_flange_cond_status', 'top_vapour_cond_status', 'top_vapour_bolts_cond_status', 'flanged_provision_cond_status', 'bottom_foot_cond_status', 'bottom_bfly_cond_status', 'bottom_outlet_flange_cond_status', 'bottom_valve_handle_cond_status', 'bottom_bfly_ball_cond_status', 'fusible_link_cond_status', 'creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$imo1List = $imo1List->where(function ($query) use ($input) {
					$query = $query->where('ref_no', 'like', '%' . strtoupper(trim($input['q'])) . '%')
						->orWhere('tank_no', 'like', '%' . strtoupper(trim($input['q'])) . '%');
				});
				$imo1List = $imo1List->orWhereHas('for_client_rec', function ($query) use ($input) {
					$query = $query->where('name', 'like', '%' . trim($input['q']) . '%');
				});
				// $imo1List = $imo1List->orWhereHas('customer', function ($query) use ($input) {
				// 	$query = $query->where('name', 'like', '%' . trim($input['q']) . '%');
				// });
			}
		} else {
			// Advanced search
			if (isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0) {
				foreach ($input['advfilters'] as $filter) {
					if ($filter['property'] == "__q") {
						switch ($filter['condition']) {
							case 0: // NOT EQUALS
								$imo1List = $imo1List->whereNot(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('tank_no', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$imo1List = $imo1List->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('tank_no', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$imo1List = $imo1List->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('tank_no', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$imo1List = $imo1List->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$imo1List = $imo1List->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$imo1List = $imo1List->where('status', 1);
		}
		// Role condition - customer
		$user = \App\Models\User::find($input['current_user_id']);
		if ($user->role_id == 2) {
			// Wait
			$imo1List = $imo1List->where('customer_id', $user->customer_id)->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$imo1List = $imo1List->orderByDesc(trim($input["sortBy"]));
			else
				$imo1List = $imo1List->orderBy(trim($input["sortBy"]));
		}
		else{
			$imo1List = $imo1List->orderByDesc("created_at");
		}
		if (isset($input["page"]))
			$imo1List = $imo1List->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\Imo1Export($imo1List);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'Imo1List.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'Imo1List.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'Imo1List.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'Imo1List.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'Imo1List.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$imo1List = $imo1List->get();
		}
		return \App\Http\Resources\Imo1Resource::collection($imo1List);
	}

	public function verifyTankNumber(Request $request){
		$input = $request->all();
		if (isset($input["tankNo"]) && strlen(trim($input["tankNo"])) > 0) {
			$tankNoStatus = TankContainerService::validateTankContainerNumber(trim($input["tankNo"]));
			if( $tankNoStatus == 1 ){
				// Check the last 3 entries
				$lastThree = \App\Models\Imo1::where('tank_no', trim($input["tankNo"]))
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
	
	// Duplicate the record
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\Imo1::find($objectId)->replicate(['ref_no']);
			$duplicateObject->save();
			$duplicateObject->ref_no = "C".str_pad($duplicateObject->id, 6, "0", STR_PAD_LEFT);
			$duplicateObject->created_by = Auth::id();
			$duplicateObject->save();
			// Duplicate the image
			if( $duplicateObject->walkway_image !== null && strlen($duplicateObject->walkway_image) > 0 ){
				$extension = pathinfo($duplicateObject->walkway_image, PATHINFO_EXTENSION);
				$uniqueName = 'uploads/' . uniqid() . '.' . $extension;
				if (Storage::exists($duplicateObject->walkway_image)) {
					Storage::copy($duplicateObject->walkway_image, $uniqueName);
					$duplicateObject->walkway_image = $uniqueName;
					$duplicateObject->save();
				}
			}
			return response()->json(["status" => 1, "id" => $duplicateObject->id]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Could not duplicate record."]]);
		}
	} 

	// Save imo1
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["imo1"])) {
			$imo1 = $input["imo1"];
			$objectToSave = [];
			$checkTitle = true;
			if ($imo1["action"] == "status") {
				$objectToSave["status"] = $imo1["status"];
				if ($imo1["status"] <= 0)
					$checkTitle = false;
			}
			if ($imo1["action"] == "details") {
				$rules = [
					'company_id' => 'required',
					'tank_no' => ['required','string'],
				];
				$validator = Validator::make($imo1, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $imo1;
				if ($imo1["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
				// New setting for dt_inspection_date
				if( isset($objectToSave["inspection_date"]) && strlen($objectToSave["inspection_date"]) > 0 ){
					$objectToSave["dt_inspection_date"] = date("Y-m-d", strtotime($objectToSave["inspection_date"]));
				}
			}
			$imo1Object = \App\Models\Imo1::updateOrCreate(["id" => $imo1["id"]], $objectToSave);
			if( $imo1["id"] == 0 ){
				// If this is a new object
				$imo1Object->ref_no = "C".str_pad($imo1Object->id, 6, "0", STR_PAD_LEFT);
				// Also check if the user is a surveyor, set the status to 0
				$user = \App\Models\User::find(Auth::id());
				if( $user->role_id == 4 ){
					$imo1Object->status = 0;
				}
				$imo1Object->save();
			}
			return response()->json(["status" => 1, "id" => $imo1Object->id]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for IMO 1 Condition is missing."]]);
		}
	}

	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			$imo1 = \App\Models\Imo1::find($objectId);
			if( $imo1 != null ){
				$allMedia = \App\Models\Media::where('object_id', $objectId)->get();
				foreach($allMedia as $mediaObject){
					$filePath = $mediaObject->url;
					if( strlen($filePath) > 0 && Storage::exists($filePath) ){
						Storage::delete($filePath);
						$mediaObject->delete();
					}
				}
				$walkwayImage1 = $imo1->walkway_image_1;
				if( $walkwayImage1 != null && strlen($walkwayImage1) > 5 && Storage::exists($walkwayImage1) ){
					Storage::delete($walkwayImage1);
				}
				$imo1->delete();
			}
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}

	// Handle uploads
	public function uploadFile(Request $request){
		$input = $request->all();
		log::info($input);
		if( isset($input["imo1_id"]) ){
			log::info($input["imo1_id"]);
			$imo1 = Imo1::find($input["imo1_id"]);
			// Clear the imo1 image first
			$this->clearUpload($imo1->walkway_image);
			// Now upload the imo1 image
			if ( $request->hasFile('uploaded_file') && $request->file('uploaded_file')->isValid()) {
				log::info("hAS FILE");
				$path = $request->file('uploaded_file')->store('uploads');
				$imo1->walkway_image = $path;
				$imo1->save();
				return response()->json(["status" => 1]);
			}
			else
				return response()->json(["status" => -1]);
		}
		else
			return response()->json(["status" => -1]);
	}

	public function viewFile($imo1Id, $randomId){
		$imo1 = Imo1::find($imo1Id);
		$filePath = $imo1->walkway_image;
		if( strlen($filePath) > 0 && Storage::exists($filePath) ){
			return response()->file(Storage::path($filePath), ['Content-Type', 'image/jpg']);
		}
		else 
			return response()->json(["file" => $filePath]);
	}

	public function clearUpload($filePath){
		if( strlen($filePath) > 0 && Storage::exists($filePath) ){
			Storage::delete($filePath);
			return response()->json(["status" => 1]);
		}
		else
			return response()->json(["status" => -1]);
	}

	public function clearFile($imo1Id, $randomId){
		$imo1 = \App\Models\Imo1::find($imo1Id);
		$filePath = $imo1->walkway_image;
		$this->clearUpload($filePath);
		$imo1->walkway_image = null;
		$imo1->save();
		return response()->json(["status" => 1]);
	}

	// Export to PDF
	public function exportToPDF($imo1ConditionId, Request $request){
		$imo1Condition = \App\Models\Imo1::with('company', 'tanktype', 'tcode', 'for_client_rec', 'surveyor', 'inspection_location', 'customer', 'ladder_cond_status', 'document_box_cond_status', 'temperature_gauge_cond_status', 'steam_cond_status', 'steam_pressure_cond_status', 'remote_system_cond_status', 'electrical_heating_cond_status', 'manlid_cond_status', 'manlid_swing_cond_status', 'insp_hatch_cond_status', 'insp_hatch_swing_bolt_cond_status', 'spill_box_cond_status', 'pre_valve_cond_status', 'pre_bursting_disc_cond_status', 'walkyway_ls_cond_status', 'walkyway_scs_cond_status', 'walkyway_mls_cond_status', 'airline_valve_cond_status', 'tank_gauge_cond_status', 'dipstick_cond_status', 'calibration_chart_cond_status', 'syphon_pipe_cond_status', 'bfly_valve_cond_status', 'blank_flange_cond_status', 'top_vapour_cond_status', 'top_vapour_bolts_cond_status', 'flanged_provision_cond_status', 'bottom_foot_cond_status', 'bottom_bfly_cond_status', 'bottom_outlet_flange_cond_status', 'bottom_valve_handle_cond_status', 'bottom_bfly_ball_cond_status', 'fusible_link_cond_status', 'creator')->find($imo1ConditionId);
		$company = $imo1Condition["company"];
		$filename = $imo1Condition->tank_no.".pdf";
		$data = [
			'imoACondition' => $imo1Condition,
		];
		if( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ){
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$company["signature_url"]);
			$signImage = 'data:image/'.strtoupper($signPathInfo['extension']).';base64,'.base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;
			$data["walkway_image"] = null;
			if( isset($imo1Condition["walkway_image"]) && strlen($imo1Condition["walkway_image"]) > 0 ){
				// lets extract the walkway image
				$walkwayPathInfo = pathinfo($imo1Condition["walkway_image"]);
				$walkwayAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$imo1Condition["walkway_image"]);
				$walkwayImage = 'data:image/'.strtoupper($walkwayPathInfo['extension']).';base64,'.base64_encode(file_get_contents($walkwayAbsolutePath));
				$data["walkway_image"] = $walkwayImage;
			}

			// Lets get the condition status array
			$imo1ConditionStatusArr = \App\Models\ImoConditionStatus::get();
			$imo1ConditionStatuses = [];
			foreach ($imo1ConditionStatusArr as $imo1ConditionStatus) {
				$imo1ConditionStatuses[$imo1ConditionStatus['id']] = $imo1ConditionStatus;
			}
			$data["imo1ConditionStatuses"] = $imo1ConditionStatuses;
			$view = View::make('pdfs.imo1condition', $data);
			$html = $view->render();
			$pdf = new \App\Models\BotPDF;
			$pdf->headerImage = $company["header_url"];
			// set default header data
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			// $pdf->SetFooterMargin(2);
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "", "");
			// set margins
			// $pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT, true);
			$pdf->SetAutoPageBreak(TRUE, 1);
			$pdf->SetTitle($imo1Condition->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $imo1Condition->id)->where('object_name', "IMO1Condition")->get();
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
