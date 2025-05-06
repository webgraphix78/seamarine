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
use App\Models\EquipmentInspection;
use App\Models\Media;
use Illuminate\Support\Facades\View;

class EquipmentInspectionController extends Controller{

	//
	public function index(){
		$component = 'equipmentinspection-component';

		 // Check if the user is authenticated
		 if (!auth()->check()) {
			abort(403, 'Unauthorized access');
		}

		$all_permissions = ActionsService::getPermissions("EquipmentInspection", auth()->user()->role_id);
		if( $all_permissions == null )
			abort(403);

		$current_user_id = auth()->id();
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request){
		$input = $request->all();
		$equipmentinspectionList = \App\Models\EquipmentInspection::with('rel_company_id', 'rel_surveyor_id', 'rel_for_id', 'rel_inspection_location_id', 'rel_customer_id', )->select("*");
		if( isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0 ){
			foreach($input['advfilters'] as $filter){
				if( $filter['property'] == "__q" ){
					switch($filter['condition']){
						case 0: // NOT EQUALS
							$equipmentinspectionList = $equipmentinspectionList->whereNot('ref_no', trim($filter['search_for_value']))->whereNot('inspection_date', trim($filter['search_for_value']))->whereNot('tank_no', trim($filter['search_for_value']))->whereNot('last_cargo_carried', trim($filter['search_for_value']));
							break;
						case 1: // EQUALS
							$equipmentinspectionList = $equipmentinspectionList->where(function($query) use ($filter) {
								$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('inspection_date', trim($filter['search_for_value']))->orWhere('tank_no', trim($filter['search_for_value']))->orWhere('last_cargo_carried', trim($filter['search_for_value']));
							});
							break;
						case 22: // CONTAINS
							$equipmentinspectionList = $equipmentinspectionList->where(function($query) use ($filter) {
								$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('inspection_date', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('tank_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('last_cargo_carried', 'like', '%' . trim($filter['search_for_value']) . '%');
							});
							break;
						case 23: // DOES NOT CONTAIN
							$equipmentinspectionList = $equipmentinspectionList->where('ref_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('inspection_date', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('tank_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('last_cargo_carried', 'not like', '%' . trim($filter['search_for_value']) . '%');
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
						$equipmentinspectionList = $equipmentinspectionList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
					}
					else if( $searchType == 'between' ){
						$equipmentinspectionList = $equipmentinspectionList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
					} else if ($searchType == 'like') {
						$equipmentinspectionList = $equipmentinspectionList->where($filter['property'], $condition,'%'.$filter['search_for_value'].'%');
					} else if ($searchType == 'master') {
						if(is_array($filter['search_for_value']) && array_key_exists("id", $filter['search_for_value']) )
							$equipmentinspectionList = $equipmentinspectionList->where($filter['property'], $condition, $filter['search_for_value']['id']);
					}
				}
			}
		}
		if( isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0 ){
			if( trim($input["sortOrder"]) == "desc" )
				$equipmentinspectionList = $equipmentinspectionList->orderByDesc(trim($input["sortBy"]));
			else
				$equipmentinspectionList = $equipmentinspectionList->orderBy(trim($input["sortBy"]));
		}
		if( isset($input["page"]) )
			$equipmentinspectionList = $equipmentinspectionList->paginate(10);
		else{
			if( isset($input["download"]) ){
				$export = new \App\Exports\EquipmentInspectionExport($equipmentinspectionList);
				switch( $input["download"] ){
					case 'XLSX':
						return Excel::download($export, 'EquipmentInspectionList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'EquipmentInspectionList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'EquipmentInspectionList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'EquipmentInspectionList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'EquipmentInspectionList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			}
			else
				$equipmentinspectionList = $equipmentinspectionList->get();
		}
		return \App\Http\Resources\EquipmentInspectionResource::collection($equipmentinspectionList);
	}

	public function add(){
		$component = "addedit-equipmentinspection-component";
		return view('common.index', compact("component"));
	}

	public function edit($id){
		$component = "addedit-equipmentinspection-component";
		$objectId = $id;
		$object = \App\Models\EquipmentInspection::find($objectId);
		if( $object == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}


	public function getRecord($objectId){
		$object = \App\Models\EquipmentInspection::with('rel_company_id', 'rel_surveyor_id', 'rel_for_id', 'rel_inspection_location_id', 'rel_customer_id', )->find($objectId);
		return $object->toJson();
	}

	public function view($id){
        $component = "view-equipmentinspection-component";
        $objectId = $id;
        if( \App\Models\EquipmentInspection::find($objectId) == null ){
            $component = "object-not-found";
        }
        return view('common.index', compact("component", "objectId"));
    }

	// Save equipmentinspection
	public function save(Request $request){
		$input = $request->all();
		if( isset($input["equipmentinspection"]) ){
			$equipmentinspection = $input["equipmentinspection"];
			$objectToSave = [];
			$checkTitle = true;
			if( $equipmentinspection["action"] == "status" ){
				$objectToSave["status"] = $equipmentinspection["status"];
				if( $equipmentinspection["status"] <= 0 )
					$checkTitle = false;
			}
			if( $equipmentinspection["action"] == "details" ){
				$rules = [
					
				];
				$validator = Validator::make($equipmentinspection, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray())) ]);
				}
				$objectToSave = $equipmentinspection;
				if(  $equipmentinspection["id"] == 0 ){
					if(!isset($objectToSave["created_by"]) ){
						$objectToSave["created_by"] = Auth::id();
					}
					if( $equipmentinspection['ref_no']=== 'AUTOGENERATED'){
						$objectToSave['ref_no'] = time();
					}
				}
				else
					unset($objectToSave["created_by"]);

			}

			$equipmentinspectionData =\App\Models\EquipmentInspection::updateOrCreate( [ "id" => $equipmentinspection["id"] ], $objectToSave );
			return response()->json(["status" => 1, "id" => $equipmentinspectionData->id]);
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Data for EquipmentInspection is missing."]]);
		}
	}

	// Duplicate the record
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\EquipmentInspection::find($objectId)->replicate([]);
			$duplicateObject->save();
			
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
        $equipmentinspection = \App\Models\EquipmentInspection::find($request->id);
        if ($request->status == 0) {
            // Soft delete the record
            $equipmentinspection->delete();
        } else {
            // Restore the soft deleted record
            $equipmentinspection->restore();
        }

        return response()->json(['status' => 1, 'message' => 'EquipmentInspection updated successfully']);
    }

	
	public function exportToPDF($equipmentinspectionId, Request $request){
		$equipmentinspection = \App\Models\EquipmentInspection::with('rel_company_id', 'rel_surveyor_id', 'rel_for_id', 'rel_inspection_location_id', 'rel_customer_id')->find($equipmentinspectionId);
		$company = $equipmentinspection["rel_company_id"];
		$filename = $equipmentinspection->ref_no . ".pdf";
		$data = [
			'equipmentinspection' => $equipmentinspection,
		];
		if (strlen($company["header_url"]) > 0 && storage_path('app/' . $company["header_url"]) && strlen($company["signature_url"]) > 0 && storage_path('app/' . $company["signature_url"])) {
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app" . DIRECTORY_SEPARATOR . $company["signature_url"]);
			$signImage = 'data:image/' . strtoupper($signPathInfo['extension']) . ';base64,' . base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.equipmentinspection', $data);
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
			$pdf->SetTitle($equipmentinspection->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $equipmentinspection->id)->where('object_name', "Joint Survey")->get();
			if (count($images) > 0) {
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

					$pdf->AddPage(($imageWidth > $imageHeight ? 'L' : 'P'), 'A4'); //array($imageWidthMM, $imageHeightMM));
					$pageWidth = $pdf->getPageWidth();
					$pageHeight = $pdf->getPageHeight();
					$pdf->Image( $imageAbsolutePath,0,0,$pageWidth,$pageHeight,'','','',true,300,'',false,false,0,'LT',false,false);
				}
			}
			// $pdf->Output($filename, 'D');
			return response($pdf->Output($filename, 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
		} else {
			return response()->json(["status" => -100, "messages" => ["Company header or signature is missing."]]);
		}
	}
	
}
