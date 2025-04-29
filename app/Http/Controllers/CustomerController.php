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
use App\Services\UserService;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{

	//
	public function index()
	{
		$component = 'customer-component';
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
		$customerList = \App\Models\Customer::with('creator')->select("*");
		// SIMPLE & ADVANCED SEARCH ClAUSE
		$searchType = "simple";
		if (isset($input["search"]))
			$searchType = $input["search"];
		if ($searchType == "simple") {
			if (isset($input["q"]) && strlen(trim($input["q"])) > 0) {
				$customerList = $customerList->where(function ($query) use ($input) {
					$query = $query->where('name', 'like', '%' . trim($input['q']) . '%')
						->orWhere('contact_person', 'like', '%' . trim($input['q']) . '%')->orWhere('mobile_number', 'like', '%' . trim($input['q']) . '%');
				});
				$customerList = $customerList->orWhereHas('creator', function ($query) use ($input) {
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
								$customerList = $customerList->whereNot(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']))
										->orWhere('contact_person', trim($filter['search_for_value']))->orWhere('mobile_number', trim($filter['search_for_value']));
								});
								break;
							case 1: // EQUALS
								$customerList = $customerList->where(function ($query) use ($filter) {
									$query = $query->where('name', trim($filter['search_for_value']))
										->orWhere('contact_person', trim($filter['search_for_value']))->orWhere('mobile_number', trim($filter['search_for_value']));
								});
								break;
							case 22: // CONTAINS
								$customerList = $customerList->where(function ($query) use ($filter) {
									$query = $query->where('name', 'like', '%' . trim($filter['search_for_value']) . '%')
										->orWhere('contact_person', 'like', '%' . trim($filter['search_for_value']) . '%')->orWhere('mobile_number', 'like', '%' . trim($filter['search_for_value']) . '%');
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
							$customerList = $customerList->where($filter['property'], $condition, (($filter['type'] == 'text' || $filter['type'] == 'dropdown') ? $filter['search_for_value'] : $filter['from_value']));
						} else if ($searchType == 'between') {
							$customerList = $customerList->where($filter['property'], '>=', $filter['from_value'])->where($filter['property'], '<=', $filter['to_value']);
						}
					}
				}
			}
		}
		// SIMPLE & ADVANCED SEARCH ClAUSE
		if (isset($input["active"]) && is_numeric($input["active"]) && $input["active"] == 1) {
			$customerList = $customerList->where('status', 1);
		}
		if (isset($input["sortBy"]) && strlen(trim($input["sortBy"])) > 0) {
			if (trim($input["sortOrder"]) == "desc")
				$customerList = $customerList->orderByDesc(trim($input["sortBy"]));
			else
				$customerList = $customerList->orderBy(trim($input["sortBy"]));
		}
		if (isset($input["page"]))
			$customerList = $customerList->paginate(10);
		else {
			if (isset($input["download"])) {
				$export = new \App\Exports\CustomerExport($customerList);
				switch ($input["download"]) {
					case 'XLSX':
						return Excel::download($export, 'CustomerList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
						break;
					case 'XLS':
						return Excel::download($export, 'CustomerList.xlsx', \Maatwebsite\Excel\Excel::XLS);
						break;
					case 'CSV':
						return Excel::download($export, 'CustomerList.csv', \Maatwebsite\Excel\Excel::CSV, [
							'Content-Type' => 'text/csv',
						]);
						break;
					case 'PDF':
						return Excel::download($export, 'CustomerList.pdf', \Maatwebsite\Excel\Excel::TCPDF);
						break;
					case 'ODS':
						return Excel::download($export, 'CustomerList.ods', \Maatwebsite\Excel\Excel::ODS);
						break;
				}
			} else
				$customerList = $customerList->get();
		}
		return \App\Http\Resources\CustomerResource::collection($customerList);
	}

	// Save customer
	public function save(Request $request)
	{
		$input = $request->all();
		if (isset($input["customer"])) {
			$customer = $input["customer"];
			$objectToSave = [];
			$checkTitle = true;
			if ($customer["action"] == "status") {
				$objectToSave["status"] = $customer["status"];
				if ($customer["status"] <= 0)
					$checkTitle = false;
			}
			if ($customer["action"] == "details") {
				$rules = [
					'name' => ['required','string', Rule::unique(\App\Models\Customer::class)->ignore($customer['id'])],
				];
				$validator = Validator::make($customer, $rules);
				if ($validator->fails()) {
					return response()->json(["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))]);
				}
				$objectToSave = $customer;
				if ($customer["id"] == 0) {
					if (!isset($objectToSave["created_by"]))
						$objectToSave["created_by"] = Auth::id();
				} else
					unset($objectToSave["created_by"]);
			}
			$newCustomer = \App\Models\Customer::updateOrCreate(["id" => $customer["id"]], $objectToSave);
			// If this is a new user
			if( $customer["id"] == 0 ){
				return response()->json(UserService::createUser([
					'id' => 0,
					'name' => $customer['name'], 
					'role_id' => 2,
					'customer_id' => $newCustomer->id,
					'email' => $customer['login_id'],
					'password' => $customer['password']
				]));
			}
			return response()->json(["status" => 1]);
		} else {
			return response()->json(["status" => -100, "messages" => ["Data for Customer is missing."]]);
		}
	}

	// Delete the record
	public function deleteRecord($objectId){
		if( $objectId > 0 ){
			$customer = \App\Models\Customer::find($objectId);
			// Delete the customer's user first
			$user = \App\Models\User::where('customer_id', $customer->id)->first();
			if( $user != null ){
				$user->delete();
			}
			// Now delete the customer
			$customer->delete();
			return response()->json(["status" => 1]);
		}
		else{
			return response()->json(["status" => -1, "messages" => ["Improper request"]]);
		}
	}
}
