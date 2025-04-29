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

class OnhireMainController extends Controller{

	//
	public function index(){
		$component = 'onhiremain-component';
		$current_user_id = auth()->id();
		if( auth()->user()->role_id == 1 ){
			$all_permissions = "111";
		}
		else{
			// Common code for authorization
			$platformObject = PlatformObject::where('name', 'OnhireMain')->first();
			$permissions = DB::table('role_object_mapping')
				->where('role_id', auth()->user()->role_id)
				->where('platform_object_id', $platformObject->id)
				->first();
			$all_permissions = "1";
			if( $permissions !== null ){
				$all_permissions .= ($permissions->can_add_edit ? "1": "0");
				$all_permissions .= ($permissions->can_delete ? "1": "0");
			}
			else
				abort(403);
		}
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request){
		$input = $request->all();
		$onhiremainList = \App\Models\OnhireMain::select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if( isset($input["search"]) )
			$searchType = $input["search"];
		if( $searchType == "simple" ){
			if( isset($input["q"]) && strlen(trim($input["q"])) > 0 ){
				$onhiremainList = $onhiremainList->where(function($query) use ($input) {
					$query = $query->where('onhire_id', 'like', '%'.trim($input['q']).'%');
				});
				
			}
		}
		else{
			// Advanced search
			if( isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0 ){
				foreach($input['advfilters'] as $filter){
					if( $filter['property'] == "__q" ){
						switch($filter['condition']){
							case 0: // NOT EQUALS
								$onhiremainList = $onhiremainList->whereNot(function($query) use ($filter) {
									$query = $query->where('onhire_id', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$onhiremainList = $onhiremainList->where(function($query) use ($filter) {
									$query = $query->where('onhire_id', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$onhiremainList = $onhiremainList->where(function($query) use ($filter) {
									$query = $query->where('onhire_id', 'like', '%'.trim($filter['search_for_value']).'%');
								});
								break;
						}
					} 
					else{
						$condition = '=';
						$searchType = 'direct';
						switch($filter['condition']){
							case 0: $condition = "!="; break;
							case 2: case 12: $condition = "<="; break;
							case 3: case 13: $condition = ">="; break;
							case 5: case 15: $searchType = 'between'; break;
						}
						if( $searchType == 'direct' ){
							$onhiremainList = $onhiremainList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						}
						else if( $searchType == 'between' ){
							$onhiremainList = $onhiremainList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if( isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1 ){
			$onhiremainList = $onhiremainList->where('status', 1);
		}
		if( isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0 ){
			if( trim($input["sortOrder"]) == "desc" )
				$onhiremainList = $onhiremainList->orderByDesc(trim($input["sortBy"]));
			else
				$onhiremainList = $onhiremainList->orderBy(trim($input["sortBy"]));
		}
		if( isset($input["page"]) )
			$onhiremainList = $onhiremainList->paginate(10);
		else{
			if( isset($input["download"]) ){
				$export = new \App\Exports\OnhireMainExport($onhiremainList);
				switch( $input["download"] ){
					case 'XLSX':
						return Excel::download($export, 'OnhireMainList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'OnhireMainList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'OnhireMainList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'OnhireMainList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'OnhireMainList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			}
			else
				$onhiremainList = $onhiremainList->get();
		}
		return \App\Http\Resources\OnhireMainResource::collection($onhiremainList);
	}

	// Save onhiremain
	public function save(Request $request){
		$input = $request->all();
		if( isset($input["onhiremain"]) ){
			$onhiremain = $input["onhiremain"];
			$objectToSave = [];
			$checkTitle = true;
			if( $onhiremain["action"] == "status" ){
				$objectToSave["status"] = $onhiremain["status"];
				if( $onhiremain["status"] <= 0 )
					$checkTitle = false;
			}
			if( $onhiremain["action"] == "details" ){
				$rules = [
					'onhire_id' => 'required|integer',

				];
				$validator = Validator::make($onhiremain, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray())) ]);
				}
				$objectToSave = $onhiremain;
				if(  $onhiremain["id"] == 0 ){
					if(!isset($objectToSave["created_by"]) )
						$objectToSave["created_by"] = Auth::id();
				}
				else
					unset($objectToSave["created_by"]);
								if( $checkTitle && \App\Models\OnhireMain::where('onhire_id', $onhiremain["onhire_id"])->where( "id", "!=", $onhiremain["id"] )->where('status', 1)->count() > 0 )
					return response()->json(["status" => -1, "messages" => ["Onhire Id has to be unique."]]);
			}
			\App\Models\OnhireMain::updateOrCreate( [ "id" => $onhiremain["id"] ], $objectToSave );
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Data for Onhire Main is missing."]]);
		}
	}
}
