<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\PlatformObject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class JointSurveyController extends Controller
{

	//
	public function index()
	{
		$component = 'jointsurvey-component';
		$current_user_id = auth()->id();
		if (auth()->user()->role_id == 1) {
			$all_permissions = "111";
		} else {
			// Common code for authorization
			$platformObject = PlatformObject::where('name', 'JointSurvey')->first();
			$permissions = DB::table('role_object_mapping')
				->where('role_id', auth()->user()->role_id)
				->where('platform_object_id', $platformObject->id)
				->first();
			$all_permissions = "1";
			if ($permissions !== null) {
				$all_permissions .= ($permissions->can_add_edit ? "1" : "0");
				$all_permissions .= ($permissions->can_delete ? "1" : "0");
			} else
				abort(403);
		}
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request)
	{
		$input = $request->all();
		$jointsurveyList = \App\Models\JointSurvey::with('company', 'surveyor', 'creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$jointsurveyList = $jointsurveyList->where(function ($query) use ($input) {
					$query = $query->where('ref_no', 'like', '%' . trim($input['q']) . '%')
						->orWhere('customer_name', 'like', '%' . trim($input['q']) . '%')->orWhere('tank_no', 'like', '%' . trim($input['q']) . '%');
				});
				$jointsurveyList = $jointsurveyList->orWhereHas('company', function ($query) use ($input) {
					$query = $query->where('title', 'like', '%' . trim($input['q']) . '%');
				});
				$jointsurveyList = $jointsurveyList->orWhereHas('surveyor', function ($query) use ($input) {
					$query = $query->where('title', 'like', '%' . trim($input['q']) . '%');
				});
				$jointsurveyList = $jointsurveyList->orWhereHas('creator', function ($query) use ($input) {
					$query = $query->where('title', 'like', '%' . trim($input['q']) . '%');
				});
			}
		} else {
			// Advanced search
			if (isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0) {
				foreach ($input['advfilters'] as $filter) {
					if ($filter['property'] == "__q") {
						switch ($filter['condition']) {
							case 0: // NOT EQUALS
								$jointsurveyList = $jointsurveyList->whereNot(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))
										->orWhere('customer_name', trim($filter['search_for_value']))->orWhere('tank_no', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$jointsurveyList = $jointsurveyList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))
										->orWhere('customer_name', trim($filter['search_for_value']))->orWhere('tank_no', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$jointsurveyList = $jointsurveyList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')
										->orWhere('customer_name', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('tank_no', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$jointsurveyList = $jointsurveyList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$jointsurveyList = $jointsurveyList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$jointsurveyList = $jointsurveyList->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$jointsurveyList = $jointsurveyList->orderByDesc(trim($input["sortBy"]));
			else
				$jointsurveyList = $jointsurveyList->orderBy(trim($input["sortBy"]));
		}
		if (isset($input["page"]))
			$jointsurveyList = $jointsurveyList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\JointSurveyExport($jointsurveyList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'JointSurveyList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'JointSurveyList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'JointSurveyList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'JointSurveyList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'JointSurveyList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$jointsurveyList = $jointsurveyList->get();
		}
		return \App\Http\Resources\JointSurveyResource::collection($jointsurveyList);
	}

	// Save jointsurvey
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["jointsurvey"])) {
			$jointsurvey = $input["jointsurvey"];
			$objectToSave = [];
			if ($jointsurvey["action"] == "status") {
				$objectToSave["status"] = $jointsurvey["status"];
			}
			if ($jointsurvey["action"] == "details") {
				$rules = [
					'company_id' => 'required',
					'tank_no' => 'required|string',
					'surveyor_id' => 'required',
				];
				$validator = Validator::make($jointsurvey, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $jointsurvey;
				if ($jointsurvey["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
			}
			$jointsurveyObject = \App\Models\JointSurvey::updateOrCreate(["id" => $jointsurvey["id"]], $objectToSave);
			if ($jointsurvey["id"] == 0) {
				// If this is a new object
				$jointsurveyObject->ref_no = $jointsurveyObject->id;
				// Also check if the user is a surveyor, set the status to 0
				$user = \App\Models\User::find(Auth::id());
				if ($user->role_id == 4) {
					$jointsurveyObject->status = 0;
				}
				$jointsurveyObject->save();
			}
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Joint Survey is missing."]]);
		}
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
						$imageAbsolutePath, 0, 0,
						$pageWidth, $pageHeight, '', '', '',
						true, 300, '', false, false, 0, 'LT', false, false
					);
				}
			}
			$pdf->Output($filename, 'D');
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Company header or signature is missing."]]);
		}
	}
}
