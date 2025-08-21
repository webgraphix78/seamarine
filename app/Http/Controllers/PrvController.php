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
use App\Models\Prv;
use App\Events\PrvSaved;
use Illuminate\Support\Facades\View;
use App\Models\Media;

class PrvController extends Controller{

	//
	public function index(){
		$component = 'prv-component';

		$all_permissions = ActionsService::getPermissions("Prv", auth()->user()->role_id);
		if( $all_permissions == null )
			abort(403);

		$current_user_id = auth()->id();
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request){
		$input = $request->all();
		$prvList = \App\Models\Prv::with('rel_customer_id', 'rel_inspection_location_id', 'rel_surveyor_id')->select("*");
		if( isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0 ){
			foreach($input['advfilters'] as $filter){
				if( $filter['property'] == "__q" ){
					switch($filter['condition']){
						case 0: // NOT EQUALS
							$prvList = $prvList->whereNot('ref', trim($filter['search_for_value']))->whereNot('date_of_issue', trim($filter['search_for_value']));
							break;
						case 1: // EQUALS
							$prvList = $prvList->where(function($query) use ($filter) {
								$query = $query->where('ref', trim($filter['search_for_value']))->orWhere('date_of_issue', trim($filter['search_for_value']));
							});
							break;
						case 22: // CONTAINS
							$prvList = $prvList->where(function($query) use ($filter) {
								$query = $query->where('ref', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('date_of_issue', 'like', '%' . trim($filter['search_for_value']) . '%');
							});
							break;
						case 23: // DOES NOT CONTAIN
							$prvList = $prvList->where('ref', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('date_of_issue', 'not like', '%' . trim($filter['search_for_value']) . '%');
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
						$prvList = $prvList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
					}
					else if( $searchType == 'between' ){
						$prvList = $prvList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
					} else if ($searchType == 'like') {
						$prvList = $prvList->where($filter['property'], $condition,'%'.$filter['search_for_value'].'%');
					} else if ($searchType == 'master') {
						if(is_array($filter['search_for_value']) && array_key_exists("id", $filter['search_for_value']) )
							$prvList = $prvList->where($filter['property'], $condition, $filter['search_for_value']['id']);
					}
				}
			}
		}
		if( isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0 ){
			if( trim($input["sortOrder"]) == "desc" )
				$prvList = $prvList->orderByDesc(trim($input["sortBy"]));
			else
				$prvList = $prvList->orderBy(trim($input["sortBy"]));
		}
		if( isset($input["page"]) )
			$prvList = $prvList->paginate(10);
		else{
			if( isset($input["download"]) ){
				$export = new \App\Exports\PrvExport($prvList);
				switch( $input["download"] ){
					case 'XLSX':
						return Excel::download($export, 'PrvList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'PrvList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'PrvList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'PrvList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'PrvList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			}
			else
				$prvList = $prvList->get();
		}
		return \App\Http\Resources\PrvResource::collection($prvList);
	}

	public function add(){
		$component = "addedit-prv-component";
		return view('common.index', compact("component"));
	}

	public function edit($id){
		$component = "addedit-prv-component";
		$objectId = $id;
		$object = \App\Models\Prv::find($objectId);
		if( $object == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}


	public function getRecord($objectId){
		$object = \App\Models\Prv::with('rel_customer_id', 'rel_inspection_location_id', 'rel_surveyor_id')->find($objectId);
		return $object->toJson();
	}

	public function view($id){
		$component = "view-prv-component";
		$objectId = $id;
		if( \App\Models\Prv::find($objectId) == null ){
			$component = "object-not-found";
		}
		return view('common.index', compact("component", "objectId"));
	}

	// Save prv
	public function save(Request $request){
		$input = $request->all();
		if( isset($input["prv"]) ){
			$prv = $input["prv"];
			$objectToSave = [];
			$checkTitle = true;
			if( $prv["action"] == "status" ){
				$objectToSave["status"] = $prv["status"];
				if( $prv["status"] <= 0 )
					$checkTitle = false;
			}
			if( $prv["action"] == "details" ){
				$rules = [
					
				];
				$validator = Validator::make($prv, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray())) ]);
				}
				$objectToSave = $prv;
				if(  $prv["id"] == 0 ){
					if(!isset($objectToSave["created_by"]) ){
						$objectToSave["created_by"] = Auth::id();
					}
					if( $prv['ref']=== 'AUTOGENERATED'){
						$objectToSave['ref'] = time();
					}
				}
				else
					unset($objectToSave["created_by"]);
			}
			$prvData =\App\Models\Prv::updateOrCreate( [ "id" => $prv["id"] ], $objectToSave );
			return response()->json(["status" => 1, "id" => $prvData->id]);
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Data for Prv is missing."]]);
		}
	}

	// Duplicate the record
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\Prv::find($objectId)->replicate([]);
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
        $prv = \App\Models\Prv::find($request->id);
        if ($request->status == 0) {
            // Soft delete the record
            $prv->delete();
        } else {
            // Restore the soft deleted record
            $prv->restore();
        }

        return response()->json(['status' => 1, 'message' => 'Prv updated successfully']);
    }

	public function exportToPDF($prvId, Request $request)
	{
		$prv = \App\Models\Prv::with('rel_company_id', 'rel_inspection_location_id', 'rel_surveyor_id', 'rel_customer_id')->find($prvId);
		$company = $prv["rel_company_id"];
		$filename = $prv->tank_no . ".pdf";
		$data = [
			'prv' => $prv,
		];
		if ( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ) {
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app" . DIRECTORY_SEPARATOR . $company["signature_url"]);
			$signImage = 'data:image/' . strtoupper($signPathInfo['extension']) . ';base64,' . base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.prv', $data);
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
			$pdf->SetTitle($prv->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output($filename, 'D');
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Company header or signature is missing."]]);
		}
	}
}
