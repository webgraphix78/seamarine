<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ActionsService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use App\Models\Media;

class ReferEquipmentController extends Controller
{

	//
	public function index()
	{
		$component = 'referequipment-component';

		$all_permissions = ActionsService::getPermissions("ReferEquipment", auth()->user()->role_id);
		if ($all_permissions == null)
			abort(403);

		$current_user_id = auth()->id();
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request)
	{
		$input = $request->all();
		log::info($input);
		$referequipmentList = \App\Models\ReferEquipment::with('rel_company_id', 'rel_inspection_location_id', 'rel_customer_id', 'rel_surveyor_id',)->select("*");

		if (isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0) {
			foreach ($input['advfilters'] as $filter) {
				if ($filter['property'] == "__q") {
					switch ($filter['condition']) {
						case 0: // NOT EQUALS
							$referequipmentList = $referequipmentList->whereNot('ref_no', trim($filter['search_for_value']))->whereNot('inspection_date', trim($filter['search_for_value']));
							break;
						case 1: // EQUALS
							$referequipmentList = $referequipmentList->where(function ($query) use ($filter) {
								$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('inspection_date', trim($filter['search_for_value']));
							});
							break;
						case 22: // CONTAINS
							$referequipmentList = $referequipmentList->where(function ($query) use ($filter) {
								$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('inspection_date', 'like', '%' . trim($filter['search_for_value']) . '%');
							});
							break;
						case 23: // DOES NOT CONTAIN
							$referequipmentList = $referequipmentList->where('ref_no', 'not like', '%' . trim($filter['search_for_value']) . '%')->where('inspection_date', 'not like', '%' . trim($filter['search_for_value']) . '%');
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
						$referequipmentList = $referequipmentList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
					} else if ($searchType == 'between') {
						$referequipmentList = $referequipmentList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
					} else if ($searchType == 'like') {
						$referequipmentList = $referequipmentList->where($filter['property'], $condition, '%' . $filter['search_for_value'] . '%');
					} else if ($searchType == 'master') {
						if (is_array($filter['search_for_value']) && array_key_exists("id", $filter['search_for_value']))
							$referequipmentList = $referequipmentList->where($filter['property'], $condition, $filter['search_for_value']['id']);
					}
				}
			}
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$referequipmentList = $referequipmentList->orderByDesc(trim($input["sortBy"]));
			else
				$referequipmentList = $referequipmentList->orderBy(trim($input["sortBy"]));
		}
		if (isset($input["page"]))
			$referequipmentList = $referequipmentList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\ReferEquipmentExport($referequipmentList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'ReferEquipmentList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'ReferEquipmentList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'ReferEquipmentList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'ReferEquipmentList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'ReferEquipmentList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$referequipmentList = $referequipmentList->get();
		}
		return \App\Http\Resources\ReferEquipmentResource::collection($referequipmentList);
	}

	public function add()
	{
		$component = "addedit-referequipment-component";
		return view('common.index', compact("component"));
	}

	public function edit($id)
	{
		$component = "addedit-referequipment-component";
		$objectId = $id;
		$object = \App\Models\ReferEquipment::find($objectId);
		if ($object == null)
			$component = "object-not-found";
		return view('common.index', compact("component", "objectId"));
	}


	public function getRecord($objectId)
	{
		$object = \App\Models\ReferEquipment::with('rel_company_id', 'rel_inspection_location_id', 'rel_customer_id', 'rel_surveyor_id',)->find($objectId);
		return $object->toJson();
	}

	public function view($id)
	{
		$component = "view-referequipment-component";
		$objectId = $id;
		if (\App\Models\ReferEquipment::find($objectId) == null) {
			$component = "object-not-found";
		}
		return view('common.index', compact("component", "objectId"));
	}

	// Save referequipment
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["referequipment"])) {
			$referequipment = $input["referequipment"];
			$objectToSave = [];
			if ($referequipment["action"] == "status") {
				$objectToSave["status"] = $referequipment["status"];
			}
			if ($referequipment["action"] == "details") {
				$rules = [];
				$validator = Validator::make($referequipment, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $referequipment;
				if ($referequipment["id"] == 0) {
					if (!isset($objectToSave["created_by"])) {
						$objectToSave["created_by"] = Auth::id();
					}
					if ($referequipment['ref_no'] === 'AUTOGENERATED') {
						$objectToSave['ref_no'] = time();
					}
				} else
					unset($objectToSave["created_by"]);
			}

			if (isset($referequipment['container_type']) && is_array($referequipment['container_type'])) {
				$objectToSave['container_type'] = json_encode($referequipment['container_type']);
			}

			$referequipmentData = \App\Models\ReferEquipment::updateOrCreate(["id" => $referequipment["id"]], $objectToSave);
			// event(new ReferEquipmentSaved($referequipmentData));
			return response()->json(["status" => 1, "id" => $referequipmentData->id]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for ReferEquipment is missing."]]);
		}
	}

	// Duplicate the record
	public function duplicateRecord(Request $request)
	{
		$input = $request->all();
		if (isset($input["id"])) {
			$objectId = $input["id"];
			$duplicateObject = \App\Models\ReferEquipment::find($objectId)->replicate([]);
			$duplicateObject->save();

			$duplicateObject->created_by = Auth::id();
			$duplicateObject->save();

			return response()->json(["status" => 1, "id" => $duplicateObject->id]);
		} else {
			return response()->json(["status" => -1, "messages" => ["Could not duplicate record."]]);
		}
	}

	// Delete the record
	public function deleteRecord(Request $request)
	{
		$referequipment = \App\Models\ReferEquipment::find($request->id);
		if ($request->status == 0) {
			// Soft delete the record
			$referequipment->delete();
		} else {
			// Restore the soft deleted record
			$referequipment->restore();
		}

		return response()->json(['status' => 1, 'message' => 'ReferEquipment updated successfully']);
	}

	public function exportToPDF($jointsurveyId, Request $request)
	{
		$jointsurvey = \App\Models\JointSurvey::with('company', 'surveyor', 'creator')->find($jointsurveyId);
		$company = $jointsurvey["company"];
		$filename = $jointsurvey->tank_no . ".pdf";
		$data = [
			'jointsurvey' => $jointsurvey,
		];
		if (strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"])) {
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app" . DIRECTORY_SEPARATOR . $company["signature_url"]);
			$signImage = 'data:image/' . strtoupper($signPathInfo['extension']) . ';base64,' . base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.jointsurvey', $data);
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
			$pdf->SetTitle($jointsurvey->tank_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight));
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $jointsurvey->id)->where('object_name', "Joint Survey")->get();
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
					$pdf->Image(
						$imageAbsolutePath,
						0,
						0,
						$pageWidth,
						$pageHeight,
						'',
						'',
						'',
						true,
						300,
						'',
						false,
						false,
						0,
						'LT',
						false,
						false
					);
				}
			}
			$pdf->Output($filename, 'D');
		} else {
			return response()->json(["status" => -100, "messages" => ["Company header or signature is missing."]]);
		}
	}
}
