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

class OnhireAncillaryController extends Controller{

	//
	public function index(){
		$component = 'onhireancillary-component';
		$current_user_id = auth()->id();
		if( auth()->user()->role_id == 1 ){
			$all_permissions = "111";
		}
		else{
			// Common code for authorization
			$platformObject = PlatformObject::where('name', 'OnhireAncillary')->first();
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
		$onhireancillaryList = \App\Models\OnhireAncillary::select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if( isset($input["search"]) )
			$searchType = $input["search"];
		if( $searchType == "simple" ){
			if( isset($input["q"]) && strlen(trim($input["q"])) > 0 ){
				$onhireancillaryList = $onhireancillaryList->where(function($query) use ($input) {
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
								$onhireancillaryList = $onhireancillaryList->whereNot(function($query) use ($filter) {
									$query = $query->where('onhire_id', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$onhireancillaryList = $onhireancillaryList->where(function($query) use ($filter) {
									$query = $query->where('onhire_id', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$onhireancillaryList = $onhireancillaryList->where(function($query) use ($filter) {
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
							$onhireancillaryList = $onhireancillaryList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						}
						else if( $searchType == 'between' ){
							$onhireancillaryList = $onhireancillaryList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if( isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1 ){
			$onhireancillaryList = $onhireancillaryList->where('status', 1);
		}
		if( isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0 ){
			if( trim($input["sortOrder"]) == "desc" )
				$onhireancillaryList = $onhireancillaryList->orderByDesc(trim($input["sortBy"]));
			else
				$onhireancillaryList = $onhireancillaryList->orderBy(trim($input["sortBy"]));
		}
		if( isset($input["page"]) )
			$onhireancillaryList = $onhireancillaryList->paginate(10);
		else{
			if( isset($input["download"]) ){
				$export = new \App\Exports\OnhireAncillaryExport($onhireancillaryList);
				switch( $input["download"] ){
					case 'XLSX':
						return Excel::download($export, 'OnhireAncillaryList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'OnhireAncillaryList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'OnhireAncillaryList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'OnhireAncillaryList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'OnhireAncillaryList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			}
			else
				$onhireancillaryList = $onhireancillaryList->get();
		}
		return \App\Http\Resources\OnhireAncillaryResource::collection($onhireancillaryList);
	}

	// Save onhireancillary
	public function save(Request $request){
		$input = $request->all();
		if( isset($input["onhireancillary"]) ){
			$onhireancillary = $input["onhireancillary"];
			$objectToSave = [];
			$checkTitle = true;
			if( $onhireancillary["action"] == "status" ){
				$objectToSave["status"] = $onhireancillary["status"];
				if( $onhireancillary["status"] <= 0 )
					$checkTitle = false;
			}
			if( $onhireancillary["action"] == "details" ){
				$rules = [
					'onhire_id' => 'required|integer',

				];
				$validator = Validator::make($onhireancillary, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray())) ]);
				}
				$objectToSave = $onhireancillary;
				if(  $onhireancillary["id"] == 0 ){
					if(!isset($objectToSave["created_by"]) )
						$objectToSave["created_by"] = Auth::id();
				}
				else
					unset($objectToSave["created_by"]);
								if( $checkTitle && \App\Models\OnhireAncillary::where('onhire_id', $onhireancillary["onhire_id"])->where( "id", "!=", $onhireancillary["id"] )->where('status', 1)->count() > 0 )
					return response()->json(["status" => -1, "messages" => ["Onhire Id has to be unique."]]);
			}
			\App\Models\OnhireAncillary::updateOrCreate( [ "id" => $onhireancillary["id"] ], $objectToSave );
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -100, "messages" => ["Data for Onhire Ancillary is missing."]]);
		}
	}
}
