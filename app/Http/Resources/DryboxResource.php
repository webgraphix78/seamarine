<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DryboxResource extends JsonResource
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
			'ref' => $this->ref,
			'company_id' => $this->company_id,
			'inspection_location_id' => $this->inspection_location_id,
			'inspection_date' => $this->inspection_date,
			'container_no' => $this->container_no,
			'size' => $this->size,
			'tare_wt' => $this->tare_wt,
			'gross_wt' => $this->gross_wt,
			'csc_no' => $this->csc_no,
			'mfgt_date' => $this->mfgt_date,
			'customer_id' => $this->customer_id,
			'surveyor_id' => $this->surveyor_id,
			'rear_end' => $this->rear_end,
			'right_side' => $this->right_side,
			'front_end' => $this->front_end,
			'left_side' => $this->left_side,
			'top_roof' => $this->top_roof,
			'under_structure' => $this->under_structure,
			'interior' => $this->interior,
			'drybox_status' => $this->drybox_status,
			'note' => $this->note,
			'image_1_url' => $this->image_1_url,
			'image_2_url' => $this->image_2_url,
			'image_3_url' => $this->image_3_url,
			'image_4_url' => $this->image_4_url,
			'image_5_url' => $this->image_5_url,
			'image_6_url' => $this->image_6_url,
			'image_7_url' => $this->image_7_url,
			'image_8_url' => $this->image_8_url,
			'image_9_url' => $this->image_9_url,
			'image_10_url' => $this->image_10_url,
			'created_by' => $this->created_by,
			'company' => $this->company,
			'inspectionlocation' => $this->inspectionlocation,
			'customer' => $this->customer,
			'surveyor' => $this->surveyor,
			'creator' => $this->creator,

			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}
}
