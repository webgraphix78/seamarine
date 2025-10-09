<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class JointSurveyResource extends JsonResource
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
			if ($currentUser->role_id != 2) {
				$actions['e'] = ['title' => '<i class="ph ph-pencil-simple"></i>', 'action' => 'editObject', 'class' => 'btn-outline-dark', 'hint' => 'Edit'];
				$actions['u'] = ['title' => '<i class="ph ph-image"></i>', 'action' => 'uploadObject', 'class' => 'btn-success', 'hint' => 'Upload Images'];
				$actions['l'] = ['title' => '<i class="ph ph-copy"></i>', 'action' => 'duplicateObject', 'class' => 'btn-info', 'hint' => 'Duplicate'];
				$isUserAdmin = true;
				if ($this->status == 1) {
					$actions['d'] = ['title' => '<i class="ph ph-trash-simple"></i>', 'action' => 'toggleObjectStatus', 'class' => 'btn-danger', 'additional_params' => [0], 'hint' => 'Delete'];
				} else {
					$actions['d'] = ['title' => '<i class="ph ph-check"></i>', 'action' => 'toggleObjectStatus', 'class' => 'btn-success', 'additional_params' => [1], 'hint' => 'Activate'];
				}
			}
			$actions['p'] = ['title' => '<i class="ph ph-printer"></i>', 'action' => 'printObject', 'class' => 'btn-primary', 'hint' => 'Print'];
		}
		return [
			'id' => $this->id,
			'ref_no' => $this->ref_no,
			'address' => $this->address,
			'company_id' => $this->company_id,
			'date_of_issue' => $this->date_of_issue,
			'customer_name' => $this->customer_name,
			'company_name' => $this->company_name,
			'instruction_1' => $this->instruction_1,
			'instruction_2' => $this->instruction_2,
			'instruction_3' => $this->instruction_3,
			'instruction_4' => $this->instruction_4,
			'instruction_5' => $this->instruction_5,
			'tank_no' => $this->tank_no,
			'mfg_date' => $this->mfg_date,
			'mgw' => $this->mgw,
			'tare_weight' => $this->tare_weight,
			'capacity' => $this->capacity,
			'csc' => $this->csc,
			'comments' => $this->comments,
			'surveyor_id' => $this->surveyor_id,
			'created_by' => $this->created_by,
			'company' => $this->company,
			'surveyor' => $this->surveyor,
			'creator' => $this->creator,

			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}
}
