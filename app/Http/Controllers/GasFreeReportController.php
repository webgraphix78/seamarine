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
use App\Models\GasFreeReport;
use App\Events\GasFreeReportSaved;
use Illuminate\Support\Facades\View;
use App\Models\Media;
use App\Services\TankContainerService;

class GasFreeReportController extends Controller{

	//
	public function index(){
		$component = 'gasfreereport-component';

		$all_permissions = ActionsService::getPermissions("GasFreeReport", auth()->user()->role_id);
		if( $all_permissions == null )
			abort(403);

		$current_user_id = auth()->id();
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request){
		$input = $request->all();
		$gasfreereportList = \App\Models\GasFreeReport::with('rel_company_id', 'rel_inspection_location_id', 'rel_customer_id', 'rel_surveyor_id', )->select("*");
		if( isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0 ){
			foreach($input['advfilters'] as $filter){
				if( $filter['property'] == "__q" ){
					switch($filter['condition']){
						case 0: // NOT EQUALS
							$gasfreereportList = $gasfreereportList->whereNot('tank_no', trim($filter['search_for_value']))->whereNot('type', trim($filter['search_for_value']))->whereNot('ref_no', trim($filter['search_for_value']))->whereNot('csc_no', trim($filter['search_for_value']))->whereNot('mfg', trim($filter['search_for_value']))->whereNot('ned', trim($filter['search_for_value']));
							break;
						case 1: // EQUALS
							$gasfreereportList = $gasfreereportList->where(function($query) use ($filter) {
								$query = $query->where('tank_no', trim($filter['search_for_value']))->orWhere('type', trim($filter['search_for_value']))->orWhere('ref_no', trim($filter['search_for_value']))->orWhere('csc_no', trim($filter['search_for_value']))->orWhere('mfg', trim($filter['search_for_value']))->orWhere('ned', trim($filter['search_for_value']));
							});
							break;
						case 22: // CONTAINS
							$gasfreereportList = $gasfreereportList->where(function($query) use ($filter) {
								$query = $query->where('tank_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('type', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('csc_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('mfg', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('ned', 'like', '%' . trim($filter['search_for_value']) . '%');
							});
							break;
						case 23: // DOES NOT CONTAIN
							$gasfreereportList = $gasfreereportList->where('tank_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('type', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('ref_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('csc_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('mfg', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('ned', 'not like', '%' . trim($filter['search_for_value']) . '%');
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
						$gasfreereportList = $gasfreereportList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
					}
					else if( $searchType == 'between' ){
						$gasfreereportList = $gasfreereportList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
					} else if ($searchType == 'like') {
						$gasfreereportList = $gasfreereportList->where($filter['property'], $condition,'%'.$filter['search_for_value'].'%');
					} else if ($searchType == 'master') {
						if(is_array($filter['search_for_value']) && array_key_exists("id", $filter['search_for_value']) )
							$gasfreereportList = $gasfreereportList->where($filter['property'], $condition, $filter['search_for_value']['id']);
					}
				}
			}
		}
		if( isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0 ){
			if( trim($input["sortOrder"]) == "desc" )
				$gasfreereportList = $gasfreereportList->orderByDesc(trim($input["sortBy"]));
			else
				$gasfreereportList = $gasfreereportList->orderBy(trim($input["sortBy"]));
		}
		if( isset($input["page"]) )
			$gasfreereportList = $gasfreereportList->paginate(10);
		else{
			if( isset($input["download"]) ){
				$export = new \App\Exports\GasFreeReportExport($gasfreereportList);
				switch( $input["download"] ){
					case 'XLSX':
						return Excel::download($export, 'GasFreeReportList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'GasFreeReportList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'GasFreeReportList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'GasFreeReportList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'GasFreeReportList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			}
			else
				$gasfreereportList = $gasfreereportList->get();
		}
		return \App\Http\Resources\GasFreeReportResource::collection($gasfreereportList);
	}

	public function add(){
		$component = "addedit-gasfreereport-component";
		return view('common.index', compact("component"));
	}

	public function edit($id){
		$component = "addedit-gasfreereport-component";
		$objectId = $id;
		$object = \App\Models\GasFreeReport::find($objectId);
		if( $object == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}


	public function getRecord($objectId){
		$object = \App\Models\GasFreeReport::with('rel_company_id', 'rel_inspection_location_id', 'rel_customer_id', 'rel_surveyor_id', )->find($objectId);
		return $object->toJson();
	}

	public function view($id){
        $component = "view-gasfreereport-component";
        $objectId = $id;
        if( \App\Models\GasFreeReport::find($objectId) == null ){
            $component = "object-not-found";
        }
        return view('common.index', compact("component", "objectId"));
    }

	// Save gasfreereport
	public function save(Request $request){
		$input = $request->all();
		if( isset($input["gasfreereport"]) ){
			$gasfreereport = $input["gasfreereport"];
			$objectToSave = [];
			$checkTitle = true;
			if( $gasfreereport["action"] == "status" ){
				$objectToSave["status"] = $gasfreereport["status"];
				if( $gasfreereport["status"] <= 0 )
					$checkTitle = false;
			}
			if( $gasfreereport["action"] == "details" ){
				$rules = [
					
				];
				$validator = Validator::make($gasfreereport, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray())) ]);
				}
				$objectToSave = $gasfreereport;
				if(  $gasfreereport["id"] == 0 ){
					if(!isset($objectToSave["created_by"]) ){
						$objectToSave["created_by"] = Auth::id();
					}
					if( $gasfreereport['ref_no']=== 'AUTOGENERATED'){
						$objectToSave['ref_no'] = time();
					}
				}
				else
					unset($objectToSave["created_by"]);
			}
			$gasfreereportData =\App\Models\GasFreeReport::updateOrCreate( [ "id" => $gasfreereport["id"] ], $objectToSave );
			return response()->json(["status" => 1, "id" => $gasfreereportData->id]);
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Data for GasFreeReport is missing."]]);
		}
	}

	// Duplicate the record
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\GasFreeReport::find($objectId)->replicate([]);
			$duplicateObject->save();
			
			$duplicateObject->created_by = Auth::id();
			$duplicateObject->save();
			return response()->json(["status" => 1, "id" => $duplicateObject->id]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Could not duplicate record."]]);
		}
	} 

	public function verifyTankNumber(Request $request){
		$input = $request->all();
		if (isset($input["tankNo"]) && strlen(trim($input["tankNo"])) > 0) {
			$tankNoStatus = TankContainerService::validateTankContainerNumber(trim($input["tankNo"]));
			if( $tankNoStatus == 1 ){
				// Check the last 3 entries
				$lastThree = \App\Models\GasFreeReport::where('tank_no', trim($input["tankNo"]))
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

	// Delete the record
	public function deleteRecord(Request $request){
        $gasfreereport = \App\Models\GasFreeReport::find($request->id);
        if ($request->status == 0) {
            // Soft delete the record
            $gasfreereport->delete();
        } else {
            // Restore the soft deleted record
            $gasfreereport->restore();
        }

        return response()->json(['status' => 1, 'message' => 'GasFreeReport updated successfully']);
    }

	public function exportToPDF($gasfreereportId, Request $request){
		$gasfreereport = \App\Models\GasFreeReport::with('rel_company_id', 'rel_inspection_location_id', 'rel_customer_id', 'rel_surveyor_id')->find($gasfreereportId);
		$company = $gasfreereport["rel_company_id"];
		$filename = $gasfreereport->tank_no.".pdf";
		$data = [
			'gasfreereport' => $gasfreereport,
		];
		log::info($gasfreereport);
		if( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ){
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$company["signature_url"]);
			$signImage = 'data:image/'.strtoupper($signPathInfo['extension']).';base64,'.base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.gasfreereport', $data);
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
			$pdf->SetTitle($gasfreereport->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $gasfreereport->id)->where('object_name', "GasFreeReport")->get();
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
