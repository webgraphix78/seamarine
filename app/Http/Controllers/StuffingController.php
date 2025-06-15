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
use App\Models\Stuffing;
use App\Events\StuffingSaved;
use Illuminate\Support\Facades\View;
use App\Models\Media;

class StuffingController extends Controller{

	//
	public function index(){
		$component = 'stuffing-component';

		$all_permissions = ActionsService::getPermissions("Stuffing", auth()->user()->role_id);
		if( $all_permissions == null )
			abort(403);

		$current_user_id = auth()->id();
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request){
		$input = $request->all();
		$stuffingList = \App\Models\Stuffing::with('rel_company_id', 'rel_customer_id', 'rel_surveyor_id', )->select("*");
		if( isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0 ){
			foreach($input['advfilters'] as $filter){
				if( $filter['property'] == "__q" ){
					switch($filter['condition']){
						case 0: // NOT EQUALS
							$stuffingList = $stuffingList->whereNot('ref_no', trim($filter['search_for_value']))->whereNot('issue_date', trim($filter['search_for_value']));
							break;
						case 1: // EQUALS
							$stuffingList = $stuffingList->where(function($query) use ($filter) {
								$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('issue_date', trim($filter['search_for_value']));
							});
							break;
						case 22: // CONTAINS
							$stuffingList = $stuffingList->where(function($query) use ($filter) {
								$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('issue_date', 'like', '%' . trim($filter['search_for_value']) . '%');
							});
							break;
						case 23: // DOES NOT CONTAIN
							$stuffingList = $stuffingList->where('ref_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('issue_date', 'not like', '%' . trim($filter['search_for_value']) . '%');
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
						$stuffingList = $stuffingList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
					}
					else if( $searchType == 'between' ){
						$stuffingList = $stuffingList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
					} else if ($searchType == 'like') {
						$stuffingList = $stuffingList->where($filter['property'], $condition,'%'.$filter['search_for_value'].'%');
					} else if ($searchType == 'master') {
						if(is_array($filter['search_for_value']) && array_key_exists("id", $filter['search_for_value']) )
							$stuffingList = $stuffingList->where($filter['property'], $condition, $filter['search_for_value']['id']);
					}
				}
			}
		}
		if( isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0 ){
			if( trim($input["sortOrder"]) == "desc" )
				$stuffingList = $stuffingList->orderByDesc(trim($input["sortBy"]));
			else
				$stuffingList = $stuffingList->orderBy(trim($input["sortBy"]));
		}
		if( isset($input["page"]) )
			$stuffingList = $stuffingList->paginate(10);
		else{
			if( isset($input["download"]) ){
				$export = new \App\Exports\StuffingExport($stuffingList);
				switch( $input["download"] ){
					case 'XLSX':
						return Excel::download($export, 'StuffingList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'StuffingList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'StuffingList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'StuffingList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'StuffingList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			}
			else
				$stuffingList = $stuffingList->get();
		}
		return \App\Http\Resources\StuffingResource::collection($stuffingList);
	}

	public function add(){
		$component = "addedit-stuffing-component";
		return view('common.index', compact("component"));
	}

	public function edit($id){
		$component = "addedit-stuffing-component";
		$objectId = $id;
		$object = \App\Models\Stuffing::find($objectId);
		if( $object == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}


	public function getRecord($objectId){
		$object = \App\Models\Stuffing::with('rel_company_id', 'rel_customer_id', 'rel_surveyor_id', )->find($objectId);
		return $object->toJson();
	}

	public function view($id){
        $component = "view-stuffing-component";
        $objectId = $id;
        if( \App\Models\Stuffing::find($objectId) == null ){
            $component = "object-not-found";
        }
        return view('common.index', compact("component", "objectId"));
    }

	// Save stuffing
	public function save(Request $request){
		$input = $request->all();
		if( isset($input["stuffing"]) ){
			$stuffing = $input["stuffing"];
			$objectToSave = [];
			$checkTitle = true;
			if( $stuffing["action"] == "status" ){
				$objectToSave["status"] = $stuffing["status"];
				if( $stuffing["status"] <= 0 )
					$checkTitle = false;
			}
			if( $stuffing["action"] == "details" ){
				$rules = [];
				$validator = Validator::make($stuffing, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray())) ]);
				}
				$objectToSave = $stuffing;
				if(  $stuffing["id"] == 0 ){
					if(!isset($objectToSave["created_by"]) ){
						$objectToSave["created_by"] = Auth::id();
					}
					if( $stuffing['ref_no']=== 'AUTOGENERATED'){
						$objectToSave['ref_no'] = time();
					}
				}
				else
					unset($objectToSave["created_by"]);
			}
			$stuffingData =\App\Models\Stuffing::updateOrCreate( [ "id" => $stuffing["id"] ], $objectToSave );
			return response()->json(["status" => 1, "id" => $stuffingData->id]);
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Data for Stuffing is missing."]]);
		}
	}
	// Duplicate the record
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\Stuffing::find($objectId)->replicate([]);
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
        $stuffing = \App\Models\Stuffing::find($request->id);
        if ($request->status == 0) {
            // Soft delete the record
            $stuffing->delete();
        } else {
            // Restore the soft deleted record
            $stuffing->restore();
        }
        return response()->json(['status' => 1, 'message' => 'Stuffing updated successfully']);
    }

	public function exportToPDF($stuffingId, Request $request){
		$stuffing = \App\Models\Stuffing::with('rel_company_id','rel_customer_id', 'rel_surveyor_id')->find($stuffingId);
		$company = $stuffing["rel_company_id"];
		$filename = $stuffing->ref_no . ".pdf";
		$data = [
			'stuffing' => $stuffing,
		];
		log::info($stuffing);
		if (strlen($company["header_url"]) > 0 && storage_path('app/' . $company["header_url"]) && strlen($company["signature_url"]) > 0 && storage_path('app/' . $company["signature_url"])) {
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app" . DIRECTORY_SEPARATOR . $company["signature_url"]);
			$signImage = 'data:image/' . strtoupper($signPathInfo['extension']) . ';base64,' . base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.stuffing', $data);
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
			$pdf->SetTitle($stuffing->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $stuffing->id)->where('object_name', "Joint Survey")->get();
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
