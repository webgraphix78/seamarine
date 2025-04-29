<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserService{

	public static function createUser($user){
		$rules = [
			'name' => ['required','string', Rule::unique(\App\Models\User::class)->ignore($user['id'])],
			'email' => 'required|email:filter',
			'role_id' => 'required',
		];
		$validator = Validator::make($user, $rules);
		if ($validator->fails()) {
			return ["status" => -1, "messages" => array_merge(...array_values($validator->errors()->toArray()))];
		}
		$objectToSave = $user;
		if (!isset($objectToSave["created_by"]))
			$objectToSave["created_by"] = Auth::id();
		$count = \App\Models\User::where("id", "!=", $user["id"])->where('status', 1)
					->where(function ($query) use ($user) {
						$query = $query->where('email', $user['email']);
						if( $user['role_id'] != 2 )
							$query = $query->orWhere('employee_code', $user['employee_code']);
					})->count();
		if ($count > 0)
			return ["status" => -1, "messages" => ["Email and Employee Code have to be unique."]];
		// Reset password if required and present 
		if( ( $objectToSave["id"] == 0 || 
			( $objectToSave["id"] > 0 && isset($objectToSave['change_password']) && $objectToSave['change_password'] == 1 ) ) && 
			isset($objectToSave['password']) && strlen($objectToSave['password']) > 0 ){
			$objectToSave['password'] = Hash::make($objectToSave['password']);
		}
		else{
			unset($objectToSave['password']);
		}
		if( $user['role_id'] == 2 ){
			$user['employee_code'] = null;
			$user['date_of_joining'] = null;
		}
		$newUser = \App\Models\User::updateOrCreate(["id" => $user["id"]], $objectToSave);
		// This is a complex logic.
		$oldHierarchyNodeId = $newUser->hierarchy_node_id;
		// Update the user's hierarchy node id
		$hierarchyNodeId = "";
		$newUser->hierarchy_node_id = $hierarchyNodeId.$newUser->id.".";
		$newUser->save();
		if( $user["id"] != 0 ){
			// check all the reportees of this user and update their hierarchy node ids
			$reportees = \App\Models\User::where('hierarchy_node_id', 'LIKE', $oldHierarchyNodeId.'%')->get();
			foreach ($reportees as $reportee) {
				// iterate over reportees and update each reportee's hierarchy_node_id with the newUser's hierarchy_node_id
				$reportee->hierarchy_node_id = $newUser->hierarchy_node_id.$reportee->id.".";
				$reportee->save();
			}
		}
		return ["status" => 1];
	}
}