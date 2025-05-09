<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Onhire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\PlatformObject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class OnhireController extends Controller
{

	//
	public function index()
	{
		$component = 'onhire-component';
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
		$component = "onhire-add-component";
		return view('common.index', compact("component"));
	}

	public function edit($onhireId)
	{
		$component = "onhire-add-component";
		$objectId = $onhireId;
		$object = \App\Models\Onhire::find($objectId);
		if( $object == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}

	public function view($onhireId)
	{
		$component = "onhire-view-component";
		$objectId = $onhireId;
		if( \App\Models\Onhire::find($objectId) == null )
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}

	public function get(Request $request)
	{
		$input = $request->all();
		$onhireList = \App\Models\Onhire::with('company', 'customer', 'inspection_location', 'surveyor', 'tank_type', 'tcode', 'creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$onhireList = $onhireList->where(function ($query) use ($input) {
					$query = $query->where('unit_nr', 'like', '%' . trim($input['q']) . '%')->orWhere('customer_id', 'like', '%' . trim($input['q']) . '%');
				});
			}
		} else {
			// Advanced search
			if (isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0) {
				foreach ($input['advfilters'] as $filter) {
					if ($filter['property'] == "__q") {
						switch ($filter['condition']) {
							case 0: // NOT EQUALS
								$onhireList = $onhireList->whereNot(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('customer_id', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$onhireList = $onhireList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('customer_id', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$onhireList = $onhireList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('customer_id', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$onhireList = $onhireList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$onhireList = $onhireList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$onhireList = $onhireList->where('status', 1);
		}
		// Role condition - customer
		$user = \App\Models\User::find($input['current_user_id']);
		if ($user->role_id == 2) {
			$onhireList = $onhireList->where('customer_id', $user->customer_id)->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$onhireList = $onhireList->orderByDesc(trim($input["sortBy"]));
			else
				$onhireList = $onhireList->orderBy(trim($input["sortBy"]));
		}
		else{
			$onhireList = $onhireList->orderByDesc("created_at");
		}
		if (isset($input["page"]))
			$onhireList = $onhireList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\OnhireExport($onhireList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'OnhireList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'OnhireList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'OnhireList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'OnhireList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'OnhireList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$onhireList = $onhireList->get();
		}
		return \App\Http\Resources\OnhireResource::collection($onhireList);
	}

	
	public function getRecord($onhireId){
		$imoRecord = \App\Models\Onhire::with('main', 'ancillary', 'unitnr', 'company', 'customer', 'inspection_location', 'surveyor', 'tank_type', 'tcode', 'creator')->find($onhireId);
		return $imoRecord->toJson();
	}

	// Save onhire
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["onhire"])) {
			$onhire = $input["onhire"];
			$objectToSave = [];
			if ($onhire["action"] == "status") {
				$objectToSave["status"] = $onhire["status"];
				if ($onhire["status"] <= 0)
					$checkTitle = false;
			}
			if ($onhire["action"] == "details") {
				$rules = [
					'company_id' => 'required',
					'customer_id' => 'required',
				];
				$validator = Validator::make($onhire, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $onhire;
				if ($onhire["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
			}
			if( $onhire["id"] == 0 ){
				// Check if the user is a surveyor, set the status to 0
				$user = \App\Models\User::find(Auth::id());
				if( $user->role_id == 4 ){
					$onhire["status"] = 0;
				}
			}
			$newOnHireObject = \App\Models\Onhire::updateOrCreate(["id" => $onhire["id"]], $objectToSave);
			if( $newOnHireObject->id > 0 ){
				$newOnHireObject->ref_no = "TP".str_pad($newOnHireObject->id, 6, "0", STR_PAD_LEFT);
				if( isset($objectToSave['main']) ){
					$objectToSave['main']['onhire_id'] = $newOnHireObject->id;
					// log::info($objectToSave['main']);
					$newOnHireMainObject = \App\Models\OnhireMain::updateOrCreate(["id" => $objectToSave['main']["id"]], $objectToSave['main']);
					$newOnHireObject->onhire_main_id = $newOnHireMainObject->id; 
					$newOnHireObject->save();
				}
				if( isset($objectToSave['ancillary']) ){
					$objectToSave['ancillary']['onhire_id'] = $newOnHireObject->id;
					$newOnHireAncillaryObject = \App\Models\OnhireAncillary::updateOrCreate(["id" => $objectToSave['ancillary']["id"]], $objectToSave['ancillary']);
					$newOnHireObject->onhire_ancillary_id = $newOnHireAncillaryObject->id; 
					$newOnHireObject->save();
				}
				if( isset($objectToSave['unitnr']) ){
					$objectToSave['unitnr']['onhire_id'] = $newOnHireObject->id;
					$newOnHireUnitnrObject = \App\Models\OnhireUnitnr::updateOrCreate(["id" => $objectToSave['unitnr']["id"]], $objectToSave['unitnr']);
					$newOnHireObject->onhire_unitnr_id = $newOnHireUnitnrObject->id; 
					$newOnHireObject->save();
				}
			}
			return response()->json(["status" => 1, "id" => $newOnHireObject->id ]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for On Hire is missing."]]);
		}
	}

	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			$onhire = \App\Models\Onhire::find($objectId);
			if( $onhire != null ){
				$onhireMain = $onhire->onhire_main_id;
				if( $onhireMain != null )
					$onhireMain->delete();
				$onhireAnc = $onhire->onhire_ancillary_id;
				if( $onhireAnc != null )
					$onhireAnc->delete();
				$onhireUnitnr = $onhire->onhire_unitnr_id;
				if( $onhireUnitnr != null )
					$onhireUnitnr->delete();
				$walkwayImage1 = $onhire->walkway_image_1;
				if( $walkwayImage1 != null && strlen($walkwayImage1) > 5 && Storage::exists($walkwayImage1) ){
					Storage::delete($walkwayImage1);
				}
				$walkwayImage2 = $onhire->walkway_image_2;
				if( $walkwayImage2 != null && strlen($walkwayImage2) > 5 && Storage::exists($walkwayImage2) ){
					Storage::delete($walkwayImage2);
				}
				// delete all media
				$allMedia = \App\Models\Media::where('object_id', $objectId)->get();
				foreach($allMedia as $mediaObject){
					$filePath = $mediaObject->url;
					if( strlen($filePath) > 0 && Storage::exists($filePath) ){
						Storage::delete($filePath);
						$mediaObject->delete();
					}
				}
				$onhire->delete();
				return response()->json(["status" => 1]);
			}
			else
				return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}
	
	// Duplicate the record
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\Onhire::find($objectId)->replicate(['ref_no']);
			$duplicateObject->save();
			$duplicateObject->walkway_image_1 = null;
			$duplicateObject->walkway_image_2 = null;
			$duplicateObject->ref_no = "TP".str_pad($duplicateObject->id, 6, "0", STR_PAD_LEFT);
			$duplicateObject->created_by = Auth::id();
			$duplicateObject->save();
			if( $duplicateObject->onhire_main_id > 0 ){
				$duplicateMainObject = \App\Models\OnhireMain::find($duplicateObject->onhire_main_id)->replicate(['onhire_id']);
				$duplicateMainObject->onhire_id = $duplicateObject->id;
				$duplicateMainObject->save();
				$duplicateObject->onhire_main_id = $duplicateMainObject->id;
				$duplicateObject->save();
			}
			if( $duplicateObject->onhire_ancillary_id > 0 ){
				$duplicateAncObject = \App\Models\OnhireAncillary::find($duplicateObject->onhire_ancillary_id)->replicate(['onhire_id']);
				$duplicateAncObject->onhire_id = $duplicateObject->id;
				$duplicateAncObject->save();
				$duplicateObject->onhire_ancillary_id = $duplicateAncObject->id;
				$duplicateObject->save();
			}
			if( $duplicateObject->onhire_unitnr_id > 0 ){
				$duplicateUnitnrObject = \App\Models\OnhireUnitnr::find($duplicateObject->onhire_unitnr_id)->replicate(['onhire_id']);
				$duplicateUnitnrObject->onhire_id = $duplicateObject->id;
				$duplicateUnitnrObject->save();
				$duplicateObject->onhire_unitnr_id = $duplicateUnitnrObject->id;
				$duplicateObject->save();
			}
			return response()->json(["status" => 1, "id" => $duplicateObject->id]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Could not duplicate record."]]);
		}
	} 

	// Handle uploads
	public function uploadFile(Request $request){
		$input = $request->all();
		if( isset($input["onhire_id"]) ){
			$onhire = Onhire::find($input["onhire_id"]);
			// Now upload the onhire image
			if ( ($request->hasFile('uploaded_file_1') && $request->file('uploaded_file_1')->isValid()) || 
				 ($request->hasFile('uploaded_file_2') && $request->file('uploaded_file_2')->isValid()) ) {
				if ( $request->hasFile('uploaded_file_1') && $request->file('uploaded_file_1')->isValid()) {
					// Clear the onhire image first
					$this->clearUpload($onhire->walkway_image_1);
					$path = $request->file('uploaded_file_1')->store('uploads');
					$onhire->walkway_image_1 = $path;
					$onhire->save();
				}
				if ( $request->hasFile('uploaded_file_2') && $request->file('uploaded_file_2')->isValid()) {
					// Clear the onhire image first
					$this->clearUpload($onhire->walkway_image_2);
					$path = $request->file('uploaded_file_2')->store('uploads');
					$onhire->walkway_image_2 = $path;
					$onhire->save();
				}
				return response()->json(["status" => 1]);
			}
			else
				return response()->json(["status" => -1]);
		}
		else
			return response()->json(["status" => -1]);
	}

	public function viewFile($purpose, $onhireId, $randomId){
		$onhire = OnHire::find($onhireId);
		$filePath = "";
		if( $purpose == 1 )
			$filePath = $onhire->walkway_image_1;
		else
			$filePath = $onhire->walkway_image_2;
		if( strlen($filePath) > 0 && Storage::exists($filePath) ){
			return response()->file(Storage::path($filePath), ['Content-Type', 'image/jpg']);
		}
		else return response()->json(["file" => $filePath]);
	}

	public function clearUpload($filePath){
		if( strlen($filePath) > 0 && Storage::exists($filePath) ){
			Storage::delete($filePath);
			return true;
		}
		else
			return false;
	}

	public function clearFile($purpose, $onhireId, $randomId){
		$onhire = OnHire::find($onhireId);
		$filePath = "";
		if( $purpose == 1 )
			$filePath = $onhire->walkway_image_1;
		else
			$filePath = $onhire->walkway_image_2;
		$this->clearUpload($filePath);
		if( $purpose == 1 )
			$onhire->walkway_image_1 = null;
		else
			$onhire->walkway_image_2 = null;
		$onhire->save();
		return response()->json(["status" => 1]);
	}

	// Export to PDF
	public function exportToPDF($onhireId, Request $request){
		$onhire = \App\Models\Onhire::with('main', 'ancillary', 'unitnr', 'company', 'customer', 'inspection_location', 'surveyor', 'tank_type', 'tcode', 'creator')->find($onhireId);
		$company = $onhire["company"];
		$filename = $onhire->unit_nr.".pdf";
		$data = [
			'onhire' => $onhire,
		];
		if( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ){
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$company["signature_url"]);
			$signImage = 'data:image/'.strtoupper($signPathInfo['extension']).';base64,'.base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;
			$data["walkway_image_1"] = null;
			$data["walkway_image_2"] = null;
			if( isset($onhire["walkway_image_1"]) && strlen($onhire["walkway_image_1"]) > 4 && Storage::exists($onhire["walkway_image_1"]) ){
				// lets extract the walkway image
				$walkwayPathInfo = pathinfo($onhire["walkway_image_1"]);
				$walkwayAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$onhire["walkway_image_1"]);
				$walkwayImage = 'data:image/'.strtoupper($walkwayPathInfo['extension']).';base64,'.base64_encode(file_get_contents($walkwayAbsolutePath));
				$data["walkway_image_1"] = $walkwayImage;
			}
			if( isset($onhire["walkway_image_2"]) && strlen($onhire["walkway_image_2"]) > 4 && Storage::exists($onhire["walkway_image_2"]) ){
				// lets extract the walkway image
				$walkwayPathInfo = pathinfo($onhire["walkway_image_2"]);
				$walkwayAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$onhire["walkway_image_2"]);
				$walkwayImage = 'data:image/'.strtoupper($walkwayPathInfo['extension']).';base64,'.base64_encode(file_get_contents($walkwayAbsolutePath));
				$data["walkway_image_2"] = $walkwayImage;
			}

			$view = View::make('pdfs.onhire', $data);
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
			$pdf->SetTitle($onhire->unit_nr);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight)+5);
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $onhire->id)->where('object_name', "Onhire")->get();
			if( count($images) > 0 ){
				$pdf->SetMargins(0, 0, 0);
				// Remove header and footer
				$pdf->setPrintHeader(false);
				$pdf->setPrintFooter(false);
				foreach ($images as $image) {
					$imageAbsolutePath = storage_path("app" . DIRECTORY_SEPARATOR . $image['url']);
					if (file_exists($imageAbsolutePath)) {
						list($imageWidth, $imageHeight) = getimagesize($imageAbsolutePath);
						// Convert image dimensions to millimeters (assuming 96 DPI)
						$dpi = 96;
						$imageWidthMM = $imageWidth * 25.4 / $dpi;
						$imageHeightMM = $imageHeight * 25.4 / $dpi;

						// $pdf->AddPage(($imageWidth > $imageHeight ? 'L' : 'P'), array($imageWidthMM, $imageHeightMM));
						$pdf->AddPage(($imageWidth > $imageHeight ? 'L' : 'P'), 'A4');
						$pageWidth = $pdf->getPageWidth();
						$pageHeight = $pdf->getPageHeight();
						$pdf->Image(
							$imageAbsolutePath, 
							0, 0, $pageWidth, $pageHeight,
							'', '', '', true, 300, '', false, false, 0, 'LT', false, false);
					}
				}
			}
			$pdf->Output($filename, 'D');
		}
	}
}
