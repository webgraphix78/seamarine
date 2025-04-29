<?php

namespace App\Http\Controllers;

use App\Models\Media;
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

class WeightmentController extends Controller
{

	//
	public function index()
	{
		$component = 'weightment-component';
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

	public function get(Request $request)
	{
		$input = $request->all();
		$weightmentList = \App\Models\Weightment::with('company', 'surveyor', 'customer', 'creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$weightmentList = $weightmentList->where('ref_no', 'like', '%' . strtoupper(trim($input['q'])) . '%')
					->orWhereHas('customer', function ($query) use ($input) {
						$query = $query->where('name', 'like', '%' . trim($input['q']) . '%');
					});
			}
		} else {
			// Advanced search
			if (isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0) {
				foreach ($input['advfilters'] as $filter) {
					if ($filter['property'] == "__q") {
						switch ($filter['condition']) {
							case 0: // NOT EQUALS
								$weightmentList = $weightmentList->whereNot(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('company_id', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$weightmentList = $weightmentList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', trim($filter['search_for_value']))->orWhere('company_id', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$weightmentList = $weightmentList->where(function ($query) use ($filter) {
									$query = $query->where('ref_no', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('company_id', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$weightmentList = $weightmentList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$weightmentList = $weightmentList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$weightmentList = $weightmentList->where('status', 1);
		}
		// Role condition - customer
		$user = \App\Models\User::find($input['current_user_id']);
		if ($user->role_id == 2) {
			$weightmentList = $weightmentList->where('customer_id', $user->customer_id)->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$weightmentList = $weightmentList->orderByDesc(trim($input["sortBy"]));
			else
				$weightmentList = $weightmentList->orderBy(trim($input["sortBy"]));
		}
		else{
			$weightmentList = $weightmentList->orderByDesc("created_at");
		}
		if (isset($input["page"]))
			$weightmentList = $weightmentList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\WeightmentExport($weightmentList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'WeightmentList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'WeightmentList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'WeightmentList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'WeightmentList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'WeightmentList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$weightmentList = $weightmentList->get();
		}
		return \App\Http\Resources\WeightmentResource::collection($weightmentList);
	}

	// Save weightment
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["weightment"])) {
			$weightment = $input["weightment"];
			$objectToSave = [];
			$checkTitle = true;
			if ($weightment["action"] == "status") {
				$objectToSave["status"] = $weightment["status"];
				if ($weightment["status"] <= 0)
					$checkTitle = false;
			}
			if ($weightment["action"] == "details") {
				$rules = [
					'company_id' => 'required',
					'customer_id' => 'required',

				];
				$validator = Validator::make($weightment, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $weightment;
				if ($weightment["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
			}
			$newWeightment = \App\Models\Weightment::updateOrCreate(["id" => $weightment["id"]], $objectToSave);
			if( $weightment["id"] == 0 ){
				$newWeightment->ref_no = "W".str_pad($newWeightment->id, 6, "0", STR_PAD_LEFT);
				// Also check if the user is a surveyor, set the status to 0
				$user = \App\Models\User::find(Auth::id());
				if( $user->role_id == 4 ){
					$newWeightment->status = 0;
				}
				$newWeightment->save();
			} 
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Weightment is missing."]]);
		}
	}

	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			$allMedia = \App\Models\Media::where('object_id', $objectId)->get();
			foreach($allMedia as $mediaObject){
				$filePath = $mediaObject->url;
				if( strlen($filePath) > 0 && Storage::exists($filePath) ){
					Storage::delete($filePath);
					$mediaObject->delete();
				}
			}
			\App\Models\Weightment::find($objectId)->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}
	
	// Export to PDF
	public function exportToPDF($weightmentId, Request $request){
		$weightment = \App\Models\Weightment::with('company', 'surveyor', 'customer', 'creator')->find($weightmentId);
		$company = \App\Models\Company::find(1);
		$filename = $weightment->ref_no.".pdf";
		$data = [
			'weightment' => $weightment,
		];
		if( strlen($company["header_url"]) > 0 && Storage::exists($company["header_url"]) && strlen($company["signature_url"]) > 0 && Storage::exists($company["signature_url"]) ){
			// lets extract the invoice signature
			$signPathInfo = pathinfo($company["signature_url"]);
			$signAbsolutePath = storage_path("app".DIRECTORY_SEPARATOR.$company["signature_url"]);
			$signImage = 'data:image/'.strtoupper($signPathInfo['extension']).';base64,'.base64_encode(file_get_contents($signAbsolutePath));
			$data["sign"] = $signImage;

			$view = View::make('pdfs.weightment', $data);
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
			$pdf->SetTitle($weightment->ref_no);
			$pdf->AddPage();
			$pdf->setFontSize(10);
			$pdf->setTopMargin(round($pdf->headerHeight)+8);
			$pdf->writeHTML($html, true, false, true, false, '');
			// Get images
			$images = Media::where('object_id', $weightment->id)->where('object_name', "Weightment")->get();
			if( count($images) > 0 ){
				$pdf->SetMargins(0, 0, 0);
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

					$pdf->AddPage(($imageWidth > $imageHeight ? 'L' : 'P'), array($imageWidthMM, $imageHeightMM));
					$pageWidth = $pdf->getPageWidth();
					$pageHeight = $pdf->getPageHeight();
					$pdf->Image(
						$imageAbsolutePath, 
						0, 0, $pageWidth, $pageHeight,
						'', '', '', false, 300, '', false, false, 0, 'LT', false, false);
				}
			}
			$pdf->Output($filename, 'D');
		}		
	}
}
