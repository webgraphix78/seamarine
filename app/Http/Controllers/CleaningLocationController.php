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
use Illuminate\Validation\Rule;

class CleaningLocationController extends Controller
{

	//
	public function index()
	{
		$component = 'cleaninglocation-component';
		$current_user_id = auth()->id();
		if (auth()->user()->role_id == 1) {
			$all_permissions = "111";
		} else {
			$all_permissions = "110";
		}
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request)
	{
		$input = $request->all();
		$cleaninglocationList = \App\Models\CleaningLocation::with('creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$cleaninglocationList = $cleaninglocationList->where(function ($query) use ($input) {
					$query = $query->where('name', 'like', '%' . trim($input['q']) . '%');
				});
				$cleaninglocationList = $cleaninglocationList->orWhereHas('creator', function ($query) use ($input) {
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
								$cleaninglocationList = $cleaninglocationList->whereNot(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$cleaninglocationList = $cleaninglocationList->where(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$cleaninglocationList = $cleaninglocationList->where(function ($query) use ($filter) {
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
							$cleaninglocationList = $cleaninglocationList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$cleaninglocationList = $cleaninglocationList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$cleaninglocationList = $cleaninglocationList->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$cleaninglocationList = $cleaninglocationList->orderByDesc(trim($input["sortBy"]));
			else
				$cleaninglocationList = $cleaninglocationList->orderBy(trim($input["sortBy"]));
		}
		if (isset($input["page"]))
			$cleaninglocationList = $cleaninglocationList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\CleaningLocationExport($cleaninglocationList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'CleaningLocationList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'CleaningLocationList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'CleaningLocationList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'CleaningLocationList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'CleaningLocationList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$cleaninglocationList = $cleaninglocationList->get();
		}
		return \App\Http\Resources\CleaningLocationResource::collection($cleaninglocationList);
	}

	// Save cleaninglocation
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["cleaninglocation"])) {
			$cleaninglocation = $input["cleaninglocation"];
			$objectToSave = [];
			$checkTitle = true;
			if ($cleaninglocation["action"] == "status") {
				$objectToSave["status"] = $cleaninglocation["status"];
				if ($cleaninglocation["status"] <= 0)
					$checkTitle = false;
			}
			if ($cleaninglocation["action"] == "details") {
				$rules = [
					'name' => ['required', 'string', Rule::unique(\App\Models\CleaningLocation::class)->ignore($cleaninglocation['id'])],
				];
				$validator = Validator::make($cleaninglocation, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $cleaninglocation;
				if ($cleaninglocation["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
			}
			\App\Models\CleaningLocation::updateOrCreate(["id" => $cleaninglocation["id"]], $objectToSave);
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Cleaning Location is missing."]]);
		}
	}
	
	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			\App\Models\CleaningLocation::find($objectId)->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}
}
