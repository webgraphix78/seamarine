<?php

namespace App\Http\Controllers;

use App\Models\PlatformObject;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

	//
	public function index()
	{
		$component = 'user-component';
		$current_user_id = auth()->id();
		if( auth()->user()->role_id == 1 ){
			$all_permissions = "111";
		}
		else{
			// Common code for authorization
			$all_permissions = "100";
		}
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
	}

	public function get(Request $request){
		$input = $request->all();
		$userList = \App\Models\User::with('role', 'department', 'customer')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$userList = $userList->where(function ($query) use ($input) {
					$query = $query->where('name', 'like', '%' . trim($input['q']) . '%')
						->orWhere('employee_code', 'like', '%' . trim($input['q']) . '%');
				});
			}
		} else {
			// Advanced search
			if (isset($input['advfilters']) && is_array($input['advfilters']) && count($input['advfilters']) > 0) {
				foreach ($input['advfilters'] as $filter) {
					if ($filter['property'] == "__q") {
						switch ($filter['condition']) {
							case 0: // NOT EQUALS
								$userList = $userList->whereNot(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']))
										->orWhere('department', trim($filter['search_for_value']))
										->orWhere('employee_code', trim($filter['search_for_value']))
										->orWhere('role_id', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$userList = $userList->where(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']))
										->orWhere('department', trim($filter['search_for_value']))
										->orWhere('employee_code', trim($filter['search_for_value']))
										->orWhere('role_id', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$userList = $userList->where(function ($query) use ($filter) {
									$query = $query->where('name', 'like', '%' . trim($filter['search_for_value']) . '%')
										->orWhere('department', 'like', '%' . trim($filter['search_for_value']) . '%')
										->orWhere('employee_code', 'like', '%' . trim($filter['search_for_value']) . '%')
										->orWhere('role_id', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$userList = $userList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$userList = $userList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}

		// Access control
		if( isset($input['current_user_id']) && $input['current_user_id'] > 0 ){
			$currentUser = User::find($input['current_user_id']);
			if( $currentUser->role_id > 1 ){
				// Apply the permissions only if the user is not an administrator
				$permissions = DB::table("role_object_mapping")
					->join('platform_object', 'role_object_mapping.platform_object_id', '=', 'platform_object.id')
					->select('role_object_mapping.view_records', 'role_object_mapping.can_add_edit', 'role_object_mapping.can_delete')
					->where("role_object_mapping.role_id", $currentUser->role_id)
					->where("platform_object.name", "User")
					->first();
			}
		}

		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$userList = $userList->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$userList = $userList->orderByDesc(trim($input["sortBy"]));
			else
				$userList = $userList->orderBy(trim($input["sortBy"]));
		}

		if (isset($input["page"]))
			$userList = $userList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\UserExport($userList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'UserList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'UserList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'UserList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'UserList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'UserList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$userList = $userList->get();
		}
		$userList->append(['actions']);
		return \App\Http\Resources\UserResource::collection($userList);
		return $userList->toJson();
	}

	// public function getUserReportees(Request $request){
	// 	$input = $request->all();
	// 	if (isset($input["user_id"]) ){
	// 		$allReportees = UserService::getNestedReportees($input["user_id"]);
	// 		return response()->json([ "status" => 1, "reportees" => $allReportees ]);
	// 	}
	// 	else
	// 		return response()->json(["status" => -1 ]);
	// }

	// Save user
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["user"])) {
			$user = $input["user"];
			$objectToSave = [];
			if ($user["action"] == "status") {
				$objectToSave["status"] = $user["status"];
				\App\Models\User::updateOrCreate(["id" => $user["id"]], $objectToSave);
			}
			else if ($user["action"] == "details") {
				return response()->json(UserService::createUser($user));
			}
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for User is missing."]]);
		}
	}

	public function validateUser(Request $request){
		// Validate the request data
		if (!$request->has('username') || !$request->has('password')) {
			return response()->json([
				'status' => 0,
				'message' => 'Username and password are required.',
			]);
		}

		if ($request->input('username') == '' || $request->input('password') == '') {
			return response()->json([
				'status' => 0,
				'message' => 'Username and password cannot be empty.',
			]);
		}

		$user = User::with('role')->where('email', $request->username)->first();

		if ($user && Hash::check($request->password, $user->password)) {
			// Generate a random token
			$token = \Illuminate\Support\Str::random(60);

			// Save token in the current_token field
			$user->current_token = $token;
			$user->save();

			return response()->json([
				'status' => 1,
				'token' => $token,
				'user' => [
					'id' => $user->id,
					'name' => $user->name,
					'email' => $user->email,
					'employee_code' => $user->employee_code,
					'role' => (($user->role && !empty($user->role))? $user->role->name: "")
				],
			]);
		} else {
			return response()->json([
				'status' => 0,
				'message' => 'Invalid username or password.',
			]);
		}
	}

	public function validateUserToken(Request $request)
	{
		// Validate the request data
		if (!$request->has('user_token') || $request->input('user_token') == '') {
			return response()->json([
				'status' => 0,
				'message' => 'User Token is mandatory and cannot be empty.',
			]);
		}
		$user = User::with('role')->where('current_token', $request->user_token)->first();

		if ($user) {
			return response()->json([
				'status' => 1,
				'user' => [
					'id' => $user->id,
					'name' => $user->name,
					'email' => $user->email,
					'employee_code' => $user->employee_code,
					'role' => (($user->role && !empty($user->role))? $user->role->name: "")
				],
			]);
		} else {
			return response()->json([
				'status' => -1,
				'message' => 'Invalid token.',
			]);
		}
	}
}
