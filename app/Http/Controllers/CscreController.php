<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ActionsService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use App\Models\Media;

class CscreController extends Controller
{

	//
	public function index(){
		$component = 'cscre-component';

		$all_permissions = ActionsService::getPermissions("Cscre", auth()->user()->role_id);
		if ($all_permissions == null)
			abort(403);

		$current_user_id = auth()->id();
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request){
		$input = $request->all();
		$cscreList = \App\Models\Cscre::with('rel_company_id',)->select("*");
		if (isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0) {
			foreach ($input['advfilters'] as $filter) {
				if ($filter['property'] == "__q") {
					switch ($filter['condition']) {
						case 0: // NOT EQUALS
							$cscreList = $cscreList->whereNot('ref_no', trim($filter['search_for_value']))->whereNot('request_of_name', trim($filter['search_for_value']))->whereNot('attend', trim($filter['search_for_value']))->whereNot('of_name', trim($filter['search_for_value']))->whereNot('attend_day', trim($filter['search_for_value']))->whereNot('attend_month', trim($filter['search_for_value']))->whereNot('unit_no', trim($filter['search_for_value']));
							break;
						case 1: // EQUALS
							$cscreList = $cscreList->where(function ($query) use ($filter) {
								$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('request_of_name', trim($filter['search_for_value']))->orWhere('attend', trim($filter['search_for_value']))->orWhere('of_name', trim($filter['search_for_value']))->orWhere('attend_day', trim($filter['search_for_value']))->orWhere('attend_month', trim($filter['search_for_value']))->orWhere('unit_no', trim($filter['search_for_value']));
							});
							break;
						case 22: // CONTAINS
							$cscreList = $cscreList->where(function ($query) use ($filter) {
								$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('request_of_name', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('attend', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('of_name', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('attend_day', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('attend_month', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('unit_no', 'like', '%' . trim($filter['search_for_value']) . '%');
							});
							break;
						case 23: // DOES NOT CONTAIN
							$cscreList = $cscreList->where('ref_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('request_of_name', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('attend', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('of_name', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('attend_day', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('attend_month', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('unit_no', 'not like', '%' . trim($filter['search_for_value']) . '%');
							break;
					}
				} else {
					$condition = '=';
					$searchType = 'direct';
					switch ($filter['condition']) {
						case 0:
							if ($filter['type'] == 'master') {
								$searchType = 'master';
							}
							$condition = "!=";
							break;
						case 1:
							if ($filter['type'] == 'master') {
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
					if ($searchType == 'direct') {
						$cscreList = $cscreList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
					} else if ($searchType == 'between') {
						$cscreList = $cscreList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
					} else if ($searchType == 'like') {
						$cscreList = $cscreList->where($filter['property'], $condition, '%' . $filter['search_for_value'] . '%');
					} else if ($searchType == 'master') {
						if (is_array($filter['search_for_value']) && array_key_exists("id", $filter['search_for_value']))
							$cscreList = $cscreList->where($filter['property'], $condition, $filter['search_for_value']['id']);
					}
				}
			}
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$cscreList = $cscreList->orderByDesc(trim($input["sortBy"]));
			else
				$cscreList = $cscreList->orderBy(trim($input["sortBy"]));
		}
		if (isset($input["page"]))
			$cscreList = $cscreList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\CscreExport($cscreList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'CscreList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'CscreList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'CscreList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'CscreList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'CscreList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$cscreList = $cscreList->get();
		}
		return \App\Http\Resources\CscreResource::collection($cscreList);
	}

	public function add(){
		$component = "addedit-cscre-component";
		return view('common.index', compact("component"));
	}

	public function edit($id){
		$component = "addedit-cscre-component";
		$objectId = $id;
		$object = \App\Models\Cscre::find($objectId);
		if ($object == null)
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}


	public function getRecord($objectId){
		$object = \App\Models\Cscre::with('rel_company_id',)->find($objectId);
		return $object->toJson();
	}

	public function view($id){
		$component = "view-cscre-component";
		$objectId = $id;
		if (\App\Models\Cscre::find($objectId) == null) {
			$component = "object-not-found";
		}
		return view('common.index', compact("component", "objectId"));
	}

	// Save cscre
	public function save(Request $request){
		$input = $request->all();
		if (isset($input["cscre"])) {
			$cscre = $input["cscre"];
			$objectToSave = [];
			$checkTitle = true;
			if ($cscre["action"] == "status") {
				$objectToSave["status"] = $cscre["status"];
				if ($cscre["status"] <= 0)
					$checkTitle = false;
			}
			if ($cscre["action"] == "details") {
				$rules = [];
				$validator = Validator::make($cscre, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $cscre;
				if ($cscre["id"] == 0) {
					if (!isset($objectToSave["created_by"])) {
						$objectToSave["created_by"] = Auth::id();
					}
					if ($cscre['ref_no'] === 'AUTOGENERATED') {
						$objectToSave['ref_no'] = time();
					}
				} else
					unset($objectToSave["created_by"]);
			}


			$cscreData = \App\Models\Cscre::updateOrCreate(["id" => $cscre["id"]], $objectToSave);
			// event(new CscreSaved($cscreData));
			return response()->json(["status" => 1, "id" => $cscreData->id]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Cscre is missing."]]);
		}
	}

	// Duplicate the record
	public function duplicateRecord(Request $request){
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\Cscre::find($objectId)->replicate([]);
			$duplicateObject->save();

			$duplicateObject->created_by = Auth::id();
			$duplicateObject->save();

			return response()->json(["status" => 1, "id" => $duplicateObject->id]);
		} else {
			return response()->json(["status" => -1, "messages" => ["Could not duplicate record."]]);
		}
	}

	// Delete the record
	public function deleteRecord(Request $request){
		$cscre = \App\Models\Cscre::find($request->id);
		if ($request->status == 0) {
			// Soft delete the record
			$cscre->delete();
		} else {
			// Restore the soft deleted record
			$cscre->restore();
		}

		return response()->json(['status' => 1, 'message' => 'Cscre updated successfully']);
	}

	public function exportToPDF($cscreId, Request $request){
		$cscre = \App\Models\Cscre::with('rel_company_id', 'creator')->find($cscreId);
		$company = $cscre["rel_company_id"];
		$filename = $cscre->ref_no . ".pdf";
		$data = [
			'cscre' => $cscre,
		];

		if (strlen($company["header_url"]) > 0 && storage_path('app/' . $company["header_url"]) && strlen($company["signature_url"]) > 0 && storage_path('app/' . $company["signature_url"])) {
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app" . DIRECTORY_SEPARATOR . $company["signature_url"]);
			$signImage = 'data:image/' . strtoupper($signPathInfo['extension']) . ';base64,' . base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.cscre', $data);
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
			$pdf->SetTitle($cscre->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $cscre->id)->where('object_name', "Joint Survey")->get();
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
