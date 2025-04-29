<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class WeightmentResource extends JsonResource
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
			'v' => ['title' => '<i class="ph ph-eye"></i>', 'action' => 'viewObject', 'class' => 'btn-dark', 'hint' => 'View'],
		];
		if (isset($input['current_user_id']) && $input['current_user_id'] > 0) {
			$currentUser = \App\Models\User::find($input['current_user_id']);
			if ($currentUser->role_id != 2 ) {
				$actions['e'] = ['title' => '<i class="ph ph-pencil-simple"></i>', 'action' => 'editObject', 'class' => 'btn-outline-dark', 'hint' => 'Edit'];
				$actions['u'] = ['title' => '<i class="ph ph-image"></i>', 'action' => 'uploadObject', 'class' => 'btn-success', 'hint' => 'Upload Images'];
				$actions['l'] = ['title' => '<i class="ph ph-copy"></i>', 'action' => 'duplicateObject', 'class' => 'btn-info', 'hint' => 'Duplicate'];
				$isUserAdmin = true;
				if ($this->status == 1) {
					$actions['d'] = ['title' => '<i class="ph ph-trash-simple"></i>', 'action' => 'toggleObjectStatus', 'class' => 'btn-danger', 'additional_params' => [0], 'hint' => 'Delete'];
				}
			}
			$actions['p'] = ['title' => '<i class="ph ph-printer"></i>', 'action' => 'printObject', 'class' => 'btn-primary', 'hint' => 'Print'];
		}
		return [
			'id' => $this->id,
			'ref_no' => $this->ref_no,
			'company_id' => $this->company_id,
			'customer_id' => $this->customer_id,
			'subject' => $this->subject,
			'field_1_key' => $this->field_1_key,
			'field_1_value_1' => $this->field_1_value_1,
			'field_1_value_2' => $this->field_1_value_2,
			'field_2_key' => $this->field_2_key,
			'field_2_value_1' => $this->field_2_value_1,
			'field_2_value_2' => $this->field_2_value_2,
			'field_3_key' => $this->field_3_key,
			'field_3_value_1' => $this->field_3_value_1,
			'field_3_value_2' => $this->field_3_value_2,
			'field_4_key' => $this->field_4_key,
			'field_4_value_1' => $this->field_4_value_1,
			'field_4_value_2' => $this->field_4_value_2,
			'field_5_key' => $this->field_5_key,
			'field_5_value_1' => $this->field_5_value_1,
			'field_5_value_2' => $this->field_5_value_2,
			'comments' => $this->comments,
			'surveyor_id' => $this->surveyor_id,
			'date_of_issue' => $this->date_of_issue,
			'created_by' => $this->created_by,
			
			'surveyor' => $this->surveyor,
			'company' => $this->company,
			'customer' => $this->customer,
			'creator' => $this->creator,

			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}
}
