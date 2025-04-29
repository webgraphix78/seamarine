<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CustomerResource extends JsonResource
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
			'contact_person' => $this->contact_person,
			'fax_number' => $this->fax_number,
			'address' => $this->address,
			'email' => $this->email,
			'mobile_number' => $this->mobile_number,
			'login_id' => $this->login_id,
			'password' => $this->password,
			'is_cha' => $this->is_cha,
			'created_by' => $this->created_by,
			'creator' => $this->creator,

			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}
}
