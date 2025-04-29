<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OnhireResource extends JsonResource
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
			'company_id' => $this->company_id,
			'ref_no' => $this->ref_no,
			'customer_id' => $this->customer_id,
			'survey_type' => $this->survey_type,
			'inspection_date' => $this->inspection_date,
			'inspection_location_id' => $this->inspection_location_id,
			'form_liquid_tanks' => $this->form_liquid_tanks,
			'surveyor_id' => $this->surveyor_id,
			'unit_nr' => $this->unit_nr,
			'tank_type_id' => $this->tank_type_id,
			'tcode_id' => $this->tcode_id,
			'manufacturer' => $this->manufacturer,
			'iso_type' => $this->iso_type,
			'adr' => $this->adr,
			'serial_no' => $this->serial_no,
			'first_test' => $this->first_test,
			'first_by' => $this->first_by,
			'last_25' => $this->last_25,
			'last_25_by' => $this->last_25_by,
			'last_5' => $this->last_5,
			'last_5_by' => $this->last_5_by,
			'next_due_date' => $this->next_due_date,
			'csc_acep_date' => $this->csc_acep_date,
			'max_gross_wgt' => $this->max_gross_wgt,
			'tare_wgt' => $this->tare_wgt,
			'capacity' => $this->capacity,
			'mawp' => $this->mawp,
			'test_pressure' => $this->test_pressure,
			'steam_tube_wp' => $this->steam_tube_wp,
			'steam_test_pressure' => $this->steam_test_pressure,
			'shell_tank_material' => $this->shell_tank_material,
			'shell_head' => $this->shell_head,
			'shell_thickness' => $this->shell_thickness,
			'shell_head_thickness' => $this->shell_head_thickness,
			'comment_1' => $this->comment_1,
			'comment_2' => $this->comment_2,
			'created_by' => $this->created_by,
			'company' => $this->company,
			'customer' => $this->customer,
			'inspection_location' => $this->inspection_location,
			'surveyor' => $this->surveyor,
			'tank_type' => $this->tank_type,
			'tcode' => $this->tcode,
			'creator' => $this->creator,
			'main' => $this->main,
			'ancillary' => $this->ancillary,
			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}
}
