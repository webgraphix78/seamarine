<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UserResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$input = $request->all();
		$isUserAdmin = false;
		// Set actions
		$actions = [
			'v' => ['title' => 'View', 'action' => 'viewObject', 'class' => 'btn-dark']
		];
		if (isset($input['current_user_id']) && $input['current_user_id'] > 0) {
			$currentUser = \App\Models\User::find($input['current_user_id']);
			if ($currentUser->role_id == 1) {
				$isUserAdmin = true;
				$actions['e'] = ['title' => 'Edit', 'action' => 'editObject', 'class' => 'btn-outline-dark'];
				if ($this->status == 1) {
					$actions['d'] = ['title' => 'Deactivate', 'action' => 'toggleObjectStatus', 'class' => 'btn-secondary', 'additional_params' => [0]];
				} else {
					$actions['r'] = ['title' => 'Activate', 'action' => 'toggleObjectStatus', 'class' => 'btn-success', 'additional_params' => [1]];
				}
			}
		}
		return [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'department_id' => $this->department_id,
			'department' => $this->department,
			'date_of_joining' => $this->date_of_joining,
			'employee_code' => $this->employee_code,
			'role_id' => $this->role_id,
			'role' => $this->role,
			'customer_id' => $this->customer_id,
			'customer' => $this->customer,
			'status' => $this->status,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}
}
