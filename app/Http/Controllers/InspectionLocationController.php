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

class InspectionLocationController extends Controller
{

	//
	public function index()
	{
		$component = 'inspectionlocation-component';
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
		$inspectionlocationList = \App\Models\InspectionLocation::with('country', 'creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$inspectionlocationList = $inspectionlocationList->where(function ($query) use ($input) {
					$query = $query->where('name', 'like', '%' . trim($input['q']) . '%')->orWhere('country_id', 'like', '%' . trim($input['q']) . '%');
				});
				$inspectionlocationList = $inspectionlocationList->orWhereHas('country', function ($query) use ($input) {
					$query = $query->where('name', 'like', '%' . trim($input['q']) . '%');
				});
				$inspectionlocationList = $inspectionlocationList->orWhereHas('creator', function ($query) use ($input) {
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
								$inspectionlocationList = $inspectionlocationList->whereNot(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']))->orWhere('country_id', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$inspectionlocationList = $inspectionlocationList->where(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']))->orWhere('country_id', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$inspectionlocationList = $inspectionlocationList->where(function ($query) use ($filter) {
									$query = $query->where('name', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('country_id', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$inspectionlocationList = $inspectionlocationList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$inspectionlocationList = $inspectionlocationList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$inspectionlocationList = $inspectionlocationList->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$inspectionlocationList = $inspectionlocationList->orderByDesc(trim($input["sortBy"]));
			else
				$inspectionlocationList = $inspectionlocationList->orderBy(trim($input["sortBy"]));
		}
		if (isset($input["page"]))
			$inspectionlocationList = $inspectionlocationList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\InspectionLocationExport($inspectionlocationList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'InspectionLocationList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'InspectionLocationList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'InspectionLocationList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'InspectionLocationList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'InspectionLocationList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$inspectionlocationList = $inspectionlocationList->get();
		}
		return \App\Http\Resources\InspectionLocationResource::collection($inspectionlocationList);
	}

	// Save inspectionlocation
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["inspectionlocation"])) {
			$inspectionlocation = $input["inspectionlocation"];
			$objectToSave = [];
			$checkTitle = true;
			if ($inspectionlocation["action"] == "status") {
				$objectToSave["status"] = $inspectionlocation["status"];
				if ($inspectionlocation["status"] <= 0)
					$checkTitle = false;
			}
			if ($inspectionlocation["action"] == "details") {
				$rules = [
					'name' => ['required','string', Rule::unique(\App\Models\InspectionLocation::class)->ignore($inspectionlocation['id'])],
					'country_id' => 'required',
				];
				$validator = Validator::make($inspectionlocation, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $inspectionlocation;
				if ($inspectionlocation["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
			}
			\App\Models\InspectionLocation::updateOrCreate(["id" => $inspectionlocation["id"]], $objectToSave);
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Inspection Location is missing."]]);
		}
	}
	
	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			\App\Models\InspectionLocation::find($objectId)->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}
}
