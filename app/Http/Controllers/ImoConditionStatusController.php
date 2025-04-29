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

class ImoConditionStatusController extends Controller
{

	//
	public function index()
	{
		$component = 'imoconditionstatus-component';
		$current_user_id = auth()->id();
		if (auth()->user()->role_id == 1) {
			$all_permissions = "111";
		} else {
			// Common code for authorization
			$platformObject = PlatformObject::where('name', 'ImoConditionStatus')->first();
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
		$imoconditionstatusList = \App\Models\ImoConditionStatus::with('creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$imoconditionstatusList = $imoconditionstatusList->where(function ($query) use ($input) {
					$query = $query->where('title', 'like', '%' . trim($input['q']) . '%');
				});
				$imoconditionstatusList = $imoconditionstatusList->orWhereHas('creator', function ($query) use ($input) {
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
								$imoconditionstatusList = $imoconditionstatusList->whereNot(function ($query) use ($filter) {
									$query = $query->where('title', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$imoconditionstatusList = $imoconditionstatusList->where(function ($query) use ($filter) {
									$query = $query->where('title', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$imoconditionstatusList = $imoconditionstatusList->where(function ($query) use ($filter) {
									$query = $query->where('title', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$imoconditionstatusList = $imoconditionstatusList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$imoconditionstatusList = $imoconditionstatusList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$imoconditionstatusList = $imoconditionstatusList->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$imoconditionstatusList = $imoconditionstatusList->orderByDesc(trim($input["sortBy"]));
			else
				$imoconditionstatusList = $imoconditionstatusList->orderBy(trim($input["sortBy"]));
		}
		if (isset($input["page"]))
			$imoconditionstatusList = $imoconditionstatusList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\ImoConditionStatusExport($imoconditionstatusList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'ImoConditionStatusList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'ImoConditionStatusList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'ImoConditionStatusList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'ImoConditionStatusList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'ImoConditionStatusList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$imoconditionstatusList = $imoconditionstatusList->get();
		}
		return \App\Http\Resources\ImoConditionStatusResource::collection($imoconditionstatusList);
	}

	// Save imoconditionstatus
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["imoconditionstatus"])) {
			$imoconditionstatus = $input["imoconditionstatus"];
			$objectToSave = [];
			$checkTitle = true;
			if ($imoconditionstatus["action"] == "status") {
				$objectToSave["status"] = $imoconditionstatus["status"];
				if ($imoconditionstatus["status"] <= 0)
					$checkTitle = false;
			}
			if ($imoconditionstatus["action"] == "details") {
				$rules = [
					'title' => ['required','string', Rule::unique(\App\Models\ImoConditionStatus::class)->ignore($imoconditionstatus['id'])],
					'code' => ['required','string', Rule::unique(\App\Models\ImoConditionStatus::class)->ignore($imoconditionstatus['id'])],
				];
				$validator = Validator::make($imoconditionstatus, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $imoconditionstatus;
				if ($imoconditionstatus["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
			}
			\App\Models\ImoConditionStatus::updateOrCreate(["id" => $imoconditionstatus["id"]], $objectToSave);
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for IMO Condition Status is missing."]]);
		}
	}
	
	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			\App\Models\ImoConditionStatus::find($objectId)->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}
}
