<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\PlatformObject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{

	//
	public function index()
	{
		$component = 'company-component';
		$current_user_id = auth()->id();
		if (auth()->user()->role_id == 1) {
			$all_permissions = "111";
		} else {
			$all_permissions = "100";
		}
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request)
	{
		$input = $request->all();
		$companyList = \App\Models\Company::with('creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$companyList = $companyList->where(function ($query) use ($input) {
					$query = $query->where('name', 'like', '%' . trim($input['q']) . '%');
				});
				$companyList = $companyList->orWhereHas('creator', function ($query) use ($input) {
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
								$companyList = $companyList->whereNot(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$companyList = $companyList->where(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$companyList = $companyList->where(function ($query) use ($filter) {
									$query = $query->where('name', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$companyList = $companyList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$companyList = $companyList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$companyList = $companyList->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$companyList = $companyList->orderByDesc(trim($input["sortBy"]));
			else
				$companyList = $companyList->orderBy(trim($input["sortBy"]));
		}
		if (isset($input["page"]))
			$companyList = $companyList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\CompanyExport($companyList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'CompanyList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'CompanyList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'CompanyList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'CompanyList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'CompanyList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$companyList = $companyList->get();
		}
		return \App\Http\Resources\CompanyResource::collection($companyList);
	}

	// Save company
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["company"])) {
			$company = $input["company"];
			$objectToSave = [];
			$checkTitle = true;
			if ($company["action"] == "status") {
				$objectToSave["status"] = $company["status"];
				if ($company["id"] > 0) {
					$company = \App\Models\Company::find($company["id"]);
					log::info(json_encode($company));
					if( $company->header_url == null || strlen(trim($company->header_url)) == 0 || 
						$company->signature_url == null || strlen(trim($company->signature_url)) == 0  ){
							return response()->json(["status" => -1, "messages" => ["Please upload the header and signature images."] ]);
					}
				}
				if ($company["status"] <= 0)
					$checkTitle = false;
			}
			if ($company["action"] == "details") {
				$rules = [
					'name' => ['required','string',Rule::unique(\App\Models\Company::class)->ignore($company['id'])],
				];
				$validator = Validator::make($company, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $company;
				unset($objectToSave['header_url']);
				unset($objectToSave['signature_url']);
				if ($company["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
				if( $company["id"] > 0 ){
					$company = \App\Models\Company::find($company["id"]);
					if( $company->header_url == null || strlen(trim($company->header_url)) == 0 || 
						$company->signature_url == null || strlen(trim($company->signature_url)) == 0  )
						$objectToSave['status'] = 0;
				}
				else
					$objectToSave['status'] = 0;
			}
			\App\Models\Company::updateOrCreate(["id" => $company["id"]], $objectToSave);
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Company is missing."]]);
		}
	}

	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			\App\Models\Company::find($objectId)->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}

	// Handle uploads
	public function uploadFile(Request $request){
		$input = $request->all();
		log::info($input);
		if( isset($input["company_id"]) && $input["purpose"]){
			$company = Company::find($input["company_id"]);
			// Clear the company header first
			$this->clearFile($input["purpose"] == 1 ? $company->header_url : $company->signature_url);
			// Now upload the company header
			if ( $request->hasFile('uploaded_file') && $request->file('uploaded_file')->isValid()) {
				$path = $request->file('uploaded_file')->store('uploads');
				if( $input["purpose"] == 1 )
					$company->header_url = $path;
				else
					$company->signature_url = $path;
				$company->save();
			}
			return response()->json(["status" => 1]);
		}
		else
			return response()->json(["status" => -1]);
	}

	public function viewFile($purpose, $companyId, $randomId){
		$company = Company::find($companyId);
		$filePath = "";
		if( $purpose == 1 )
			$filePath = $company->header_url;
		else
			$filePath = $company->signature_url;
		log::info($filePath);
		if( strlen($filePath) > 0 && Storage::exists($filePath) ){
			return response()->file(Storage::path($filePath), ['Content-Type', 'image/jpg']);
		}
		else return response()->json(["file" => $filePath]);
	}

	public function clearFile($filePath){
		if( strlen($filePath) > 0 && Storage::exists($filePath) ){
			Storage::delete($filePath);
			return response()->json(["status" => 1]);
		}
		else
			return response()->json(["status" => -1]);
	}

}
