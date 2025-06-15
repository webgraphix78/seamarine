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
use App\Models\Dmcc;
use App\Events\DmccSaved;
use Illuminate\Support\Facades\View;
use App\Models\Media;
use App\Services\TankContainerService;

class DmccController extends Controller{

	//
	public function index(){
		$component = 'dmcc-component';

		$all_permissions = ActionsService::getPermissions("Dmcc", auth()->user()->role_id);
		if( $all_permissions == null )
			abort(403);

		$current_user_id = auth()->id();
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request){
		$input = $request->all();
		$dmccList = \App\Models\Dmcc::with('rel_company_id', 'rel_surveyor_id', )->select("*");
		if( isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0 ){
			foreach($input['advfilters'] as $filter){
				if( $filter['property'] == "__q" ){
					switch($filter['condition']){
						case 0: // NOT EQUALS
							$dmccList = $dmccList->whereNot('tank_no', trim($filter['search_for_value']))->whereNot('inspection_date', trim($filter['search_for_value']))->whereNot('loading_of', trim($filter['search_for_value']))->whereNot('seals_intact_time', trim($filter['search_for_value']));
							break;
						case 1: // EQUALS
							$dmccList = $dmccList->where(function($query) use ($filter) {
								$query = $query->where('tank_no', trim($filter['search_for_value']))->orWhere('inspection_date', trim($filter['search_for_value']))->orWhere('loading_of', trim($filter['search_for_value']))->orWhere('seals_intact_time', trim($filter['search_for_value']));
							});
							break;
						case 22: // CONTAINS
							$dmccList = $dmccList->where(function($query) use ($filter) {
								$query = $query->where('tank_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('inspection_date', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('loading_of', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('seals_intact_time', 'like', '%' . trim($filter['search_for_value']) . '%');
							});
							break;
						case 23: // DOES NOT CONTAIN
							$dmccList = $dmccList->where('tank_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('inspection_date', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('loading_of', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('seals_intact_time', 'not like', '%' . trim($filter['search_for_value']) . '%');
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
						$dmccList = $dmccList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
					}
					else if( $searchType == 'between' ){
						$dmccList = $dmccList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
					} else if ($searchType == 'like') {
						$dmccList = $dmccList->where($filter['property'], $condition,'%'.$filter['search_for_value'].'%');
					} else if ($searchType == 'master') {
						if(is_array($filter['search_for_value']) && array_key_exists("id", $filter['search_for_value']) )
							$dmccList = $dmccList->where($filter['property'], $condition, $filter['search_for_value']['id']);
					}
				}
			}
		}
		if( isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0 ){
			if( trim($input["sortOrder"]) == "desc" )
				$dmccList = $dmccList->orderByDesc(trim($input["sortBy"]));
			else
				$dmccList = $dmccList->orderBy(trim($input["sortBy"]));
		}
		if( isset($input["page"]) )
			$dmccList = $dmccList->paginate(10);
		else{
			if( isset($input["download"]) ){
				$export = new \App\Exports\DmccExport($dmccList);
				switch( $input["download"] ){
					case 'XLSX':
						return Excel::download($export, 'DmccList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'DmccList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'DmccList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'DmccList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'DmccList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			}
			else
				$dmccList = $dmccList->get();
		}
		return \App\Http\Resources\DmccResource::collection($dmccList);
	}

	public function add(){
		$component = "addedit-dmcc-component";
		return view('common.index', compact("component"));
	}

	public function edit($id){
		$component = "addedit-dmcc-component";
		$objectId = $id;
		$object = \App\Models\Dmcc::find($objectId);
		if( $object == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}


	public function getRecord($objectId){
		$object = \App\Models\Dmcc::with('rel_company_id', 'rel_surveyor_id', )->find($objectId);
		return $object->toJson();
	}

	public function view($id){
        $component = "view-dmcc-component";
        $objectId = $id;
        if( \App\Models\Dmcc::find($objectId) == null ){
            $component = "object-not-found";
        }
        return view('common.index', compact("component", "objectId"));
    }

	// Save dmcc
	public function save(Request $request){
		$input = $request->all();
		if( isset($input["dmcc"]) ){
			$dmcc = $input["dmcc"];
			$objectToSave = [];
			$checkTitle = true;
			if( $dmcc["action"] == "status" ){
				$objectToSave["status"] = $dmcc["status"];
				if( $dmcc["status"] <= 0 )
					$checkTitle = false;
			}
			if( $dmcc["action"] == "details" ){
				$rules = [ ];
				$validator = Validator::make($dmcc, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray())) ]);
				}
				$objectToSave = $dmcc;
				if(  $dmcc["id"] == 0 ){
					if(!isset($objectToSave["created_by"]) ){
						$objectToSave["created_by"] = Auth::id();
					}
				}
				else
					unset($objectToSave["created_by"]);
			}
			$dmccData =\App\Models\Dmcc::updateOrCreate( [ "id" => $dmcc["id"] ], $objectToSave );
			return response()->json(["status" => 1, "id" => $dmccData->id]);
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Data for Dmcc is missing."]]);
		}
	}

	// Duplicate the record
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\Dmcc::find($objectId)->replicate([]);
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
				$lastThree = \App\Models\Dmcc::where('tank_no', trim($input["tankNo"]))
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
        $dmcc = \App\Models\Dmcc::find($request->id);
        if ($request->status == 0) {
            // Soft delete the record
            $dmcc->delete();
        } else {
            // Restore the soft deleted record
            $dmcc->restore();
        }
        return response()->json(['status' => 1, 'message' => 'Dmcc updated successfully']);
    }
	
	public function exportToPDF($dmccId, Request $request){
		$dmcc = \App\Models\Dmcc::with('rel_company_id', 'rel_surveyor_id')->find($dmccId);
		$company = $dmcc["rel_company_id"];
		$filename = $dmcc->tank_no.".pdf";
		$data = [
			'dmcc' => $dmcc,
		];
		log::info($dmcc);
		if( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ){
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$company["signature_url"]);
			$signImage = 'data:image/'.strtoupper($signPathInfo['extension']).';base64,'.base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.dmcc', $data);
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
			$pdf->SetTitle($dmcc->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $dmcc->id)->where('object_name', "Dmcc")->get();
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
