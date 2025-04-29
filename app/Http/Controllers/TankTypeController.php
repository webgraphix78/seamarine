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

class TankTypeController extends Controller
{

	//
	public function index()
	{
		$component = 'tanktype-component';
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
		$tankList = \App\Models\TankType::with('creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$tankList = $tankList->where(function ($query) use ($input) {
					$query = $query->where('type', 'like', '%' . trim($input['q']) . '%');
				});
				$tankList = $tankList->orWhereHas('creator', function ($query) use ($input) {
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
								$tankList = $tankList->whereNot(function ($query) use ($filter) {
									$query = $query->where('type', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$tankList = $tankList->where(function ($query) use ($filter) {
									$query = $query->where('type', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$tankList = $tankList->where(function ($query) use ($filter) {
									$query = $query->where('type', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$tankList = $tankList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$tankList = $tankList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$tankList = $tankList->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$tankList = $tankList->orderByDesc(trim($input["sortBy"]));
			else
				$tankList = $tankList->orderBy(trim($input["sortBy"]));
		}
		if (isset($input["page"]))
			$tankList = $tankList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\TankExport($tankList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'TankList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'TankList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'TankList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'TankList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'TankList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$tankList = $tankList->get();
		}
		return \App\Http\Resources\TankResource::collection($tankList);
	}

	// Save tanktype
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["tanktype"])) {
			$tankType = $input["tanktype"];
			$objectToSave = [];
			$checkTitle = true;
			if ($tankType["action"] == "status") {
				$objectToSave["status"] = $tankType["status"];
				if ($tankType["status"] <= 0)
					$checkTitle = false;
			}
			if ($tankType["action"] == "details") {
				$rules = [
					'type' => ['required','string', Rule::unique(\App\Models\TankType::class)->ignore($tankType['id'])],
				];
				$validator = Validator::make($tankType, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $tankType;
				if ($tankType["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
			}
			\App\Models\TankType::updateOrCreate(["id" => $tankType["id"]], $objectToSave);
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Tank type is missing."]]);
		}
	}

	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			\App\Models\TankType::find($objectId)->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}
}
