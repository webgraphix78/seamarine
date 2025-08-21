<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\PlatformObject;
use App\Services\ActionsService;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\DepotConditionSurvey;
use App\Events\DepotConditionSurveySaved;
use Illuminate\Support\Facades\View;
use App\Models\Media;
use App\Services\TankContainerService;

class DepotConditionSurveyController extends Controller{

	//
	public function index(){
		$component = 'depotconditionsurvey-component';

		$all_permissions = ActionsService::getPermissions("DepotConditionSurvey", auth()->user()->role_id);
		if( $all_permissions == null )
			abort(403);

		$current_user_id = auth()->id();
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request){
		$input = $request->all();
		$depotconditionsurveyList = \App\Models\DepotConditionSurvey::with('rel_company_id', 'rel_customer_id', 'rel_inspection_location_id', 'rel_liquid_inspection_location_id', 'rel_surveyor_id', )->select("*");
		if( isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0 ){
			foreach($input['advfilters'] as $filter){
				if( $filter['property'] == "__q" ){
					switch($filter['condition']){
						case 0: // NOT EQUALS
							$depotconditionsurveyList = $depotconditionsurveyList->whereNot('tank_no', trim($filter['search_for_value']))->whereNot('ref_no', trim($filter['search_for_value']))->whereNot('inspection_date', trim($filter['search_for_value']));
							break;
						case 1: // EQUALS
							$depotconditionsurveyList = $depotconditionsurveyList->where(function($query) use ($filter) {
								$query = $query->where('tank_no', trim($filter['search_for_value']))->orWhere('ref_no', trim($filter['search_for_value']))->orWhere('inspection_date', trim($filter['search_for_value']));
							});
							break;
						case 22: // CONTAINS
							$depotconditionsurveyList = $depotconditionsurveyList->where(function($query) use ($filter) {
								$query = $query->where('tank_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('inspection_date', 'like', '%' . trim($filter['search_for_value']) . '%');
							});
							break;
						case 23: // DOES NOT CONTAIN
							$depotconditionsurveyList = $depotconditionsurveyList->where('tank_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('ref_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('inspection_date', 'not like', '%' . trim($filter['search_for_value']) . '%');
							break;						
					}
				} 
				else{
					$condition = '=';
					$searchType = 'direct';
					switch ($filter['condition']) {
						case 0:
							if($filter['type'] == 'master'){
								$searchType = 'master';
							}
							$condition = "!=";
							break;
						case 1:
							if($filter['type'] == 'master'){
								$searchType = 'master';
							}
							break; 
						case 2:
							$condition = "<=";
							break;
						case 3:
							$condition = ">=";
							break;
						case 5:
							$searchType = 'between';
							break;
						case 22: // CONTAINS
							$condition = "like";
							$searchType = 'like';
							break;
					}
					if( $searchType == 'direct' ){
						$depotconditionsurveyList = $depotconditionsurveyList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
					}
					else if( $searchType == 'between' ){
						$depotconditionsurveyList = $depotconditionsurveyList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
					} else if ($searchType == 'like') {
						$depotconditionsurveyList = $depotconditionsurveyList->where($filter['property'], $condition,'%'.$filter['search_for_value'].'%');
					} else if ($searchType == 'master') {
						if(is_array($filter['search_for_value']) && array_key_exists("id", $filter['search_for_value']) )
							$depotconditionsurveyList = $depotconditionsurveyList->where($filter['property'], $condition, $filter['search_for_value']['id']);
					}
				}
			}
		}
		if( isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0 ){
			if( trim($input["sortOrder"]) == "desc" )
				$depotconditionsurveyList = $depotconditionsurveyList->orderByDesc(trim($input["sortBy"]));
			else
				$depotconditionsurveyList = $depotconditionsurveyList->orderBy(trim($input["sortBy"]));
		}
		if( isset($input["page"]) )
			$depotconditionsurveyList = $depotconditionsurveyList->paginate(10);
		else{
			if( isset($input["download"]) ){
				$export = new \App\Exports\DepotConditionSurveyExport($depotconditionsurveyList);
				switch( $input["download"] ){
					case 'XLSX':
						return Excel::download($export, 'DepotConditionSurveyList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'DepotConditionSurveyList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'DepotConditionSurveyList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'DepotConditionSurveyList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'DepotConditionSurveyList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			}
			else
				$depotconditionsurveyList = $depotconditionsurveyList->get();
		}
		return \App\Http\Resources\DepotConditionSurveyResource::collection($depotconditionsurveyList);
	}

	public function add(){
		$component = "addedit-depotconditionsurvey-component";
		return view('common.index', compact("component"));
	}

	public function edit($id){
		$component = "addedit-depotconditionsurvey-component";
		$objectId = $id;
		$object = \App\Models\DepotConditionSurvey::find($objectId);
		if( $object == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}


	public function getRecord($objectId){
		$object = \App\Models\DepotConditionSurvey::with('rel_company_id', 'rel_customer_id', 'rel_inspection_location_id', 'rel_liquid_inspection_location_id', 'rel_surveyor_id', )->find($objectId);
		return $object->toJson();
	}

	public function view($id){
        $component = "view-depotconditionsurvey-component";
        $objectId = $id;
        if( \App\Models\DepotConditionSurvey::find($objectId) == null ){
            $component = "object-not-found";
        }
        return view('common.index', compact("component", "objectId"));
    }

	// Save depotconditionsurvey
	public function save(Request $request){
		$input = $request->all();
		if( isset($input["depotconditionsurvey"]) ){
			$depotconditionsurvey = $input["depotconditionsurvey"];
			$objectToSave = [];
			$checkTitle = true;
			if( $depotconditionsurvey["action"] == "status" ){
				$objectToSave["status"] = $depotconditionsurvey["status"];
				if( $depotconditionsurvey["status"] <= 0 )
					$checkTitle = false;
			}
			if( $depotconditionsurvey["action"] == "details" ){
				$rules = [
					'tank_no' => ['required', 'string'],

				];
				$validator = Validator::make($depotconditionsurvey, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray())) ]);
				}
				$objectToSave = $depotconditionsurvey;
				if(  $depotconditionsurvey["id"] == 0 ){
					if(!isset($objectToSave["created_by"]) ){
						$objectToSave["created_by"] = Auth::id();
					}
					if( $depotconditionsurvey['ref_no']=== 'AUTOGENERATED'){
						$objectToSave['ref_no'] = time();
					}
					
				}
				else
					unset($objectToSave["created_by"]);
			}
			$depotconditionsurveyData =\App\Models\DepotConditionSurvey::updateOrCreate( [ "id" => $depotconditionsurvey["id"] ], $objectToSave );
			return response()->json(["status" => 1, "id" => $depotconditionsurveyData->id]);
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Data for DepotConditionSurvey is missing."]]);
		}
	}

	// Duplicate the record
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\DepotConditionSurvey::find($objectId)->replicate([]);
			$duplicateObject->save();
			$duplicateObject->liquid_img = null;

			$duplicateObject->created_by = Auth::id();
			$duplicateObject->save();

			return response()->json(["status" => 1, "id" => $duplicateObject->id]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Could not duplicate record."]]);
		}
	} 

	// Delete the record
	public function deleteRecord(Request $request){
        $depotconditionsurvey = \App\Models\DepotConditionSurvey::find($request->id);
        if ($request->status == 0) {
            // Soft delete the record
            $depotconditionsurvey->delete();
        } else {
            // Restore the soft deleted record
            $depotconditionsurvey->restore();
        }

        return response()->json(['status' => 1, 'message' => 'DepotConditionSurvey updated successfully']);
    }

	// Handle uploads
	public function uploadFile(Request $request){
		$input = $request->all();
		log::info($input);
		if( isset($input["depotconditionsurvey_id"]) ){
			log::info($input["depotconditionsurvey_id"]);
			$depotconditionsurvey = \App\Models\DepotConditionSurvey::find($input["depotconditionsurvey_id"]);
			// Clear the depotconditionsurvey image first
			$this->clearUpload($depotconditionsurvey->liquid_img);
			// Now upload the depotconditionsurvey image
			if ( $request->hasFile('uploaded_file') && $request->file('uploaded_file')->isValid()) {
				log::info("hAS FILE");
				$path = $request->file('uploaded_file')->store('uploads');
				$depotconditionsurvey->liquid_img = $path;
				$depotconditionsurvey->save();
				return response()->json(["status" => 1]);
			}
			else
				return response()->json(["status" => -1]);
		}
		else
			return response()->json(["status" => -1]);
	}

	public function viewFile($depotconditionsurveyId, $randomId){
		$depotconditionsurvey = \App\Models\DepotConditionSurvey::find($depotconditionsurveyId);
		$filePath = $depotconditionsurvey->liquid_img;
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

	public function clearFile($depotconditionsurveyId, $randomId){
		$depotconditionsurvey = \App\Models\DepotConditionSurvey::find($depotconditionsurveyId);
		$filePath = $depotconditionsurvey->liquid_img;
		$this->clearUpload($filePath);
		$depotconditionsurvey->liquid_img = null;
		$depotconditionsurvey->save();
		return response()->json(["status" => 1]);
	}

	public function verifyTankNumber(Request $request){
		$input = $request->all();
		if (isset($input["tankNo"]) && strlen(trim($input["tankNo"])) > 0) {
			$tankNoStatus = TankContainerService::validateTankContainerNumber(trim($input["tankNo"]));
			if( $tankNoStatus == 1 ){
				// Check the last 3 entries
				$lastThree = \App\Models\DepotConditionSurvey::where('tank_no', trim($input["tankNo"]))
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

	public function exportToPDF($depotconditionsurveyId, Request $request){
		$depotconditionsurvey = \App\Models\DepotConditionSurvey::with('rel_company_id', 'rel_surveyor_id')->find($depotconditionsurveyId);
		$company = $depotconditionsurvey["rel_company_id"];
		$filename = $depotconditionsurvey->tank_no.".pdf";
		$data = [
			'depotconditionsurvey' => $depotconditionsurvey,
		];
		log::info($depotconditionsurvey);
		if( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ){
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$company["signature_url"]);
			$signImage = 'data:image/'.strtoupper($signPathInfo['extension']).';base64,'.base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;
			$data["liquid_img"] = null;
			$data["fixedImg"] = storage_path("app".DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."depot_condition.jpg");
			if( isset($depotconditionsurvey["liquid_img"]) && strlen($depotconditionsurvey["liquid_img"]) > 4 ){
				// lets extract the walkway image
				$walkwayPathInfo = pathinfo($depotconditionsurvey["liquid_img"]);
				$walkwayAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$depotconditionsurvey["liquid_img"]);
				if (file_exists($walkwayAbsolutePath)) {
					$liquidImg = 'data:image/'.strtoupper($walkwayPathInfo['extension']).';base64,'.base64_encode(file_get_contents($walkwayAbsolutePath));
					$data["liquid_img"] = $liquidImg;
				}
			}

			$view = View::make('pdfs.depotconditionsurvey', $data);
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
			$pdf->SetTitle($depotconditionsurvey->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $depotconditionsurvey->id)->where('object_name', "Depot Condition Survey")->get();
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
