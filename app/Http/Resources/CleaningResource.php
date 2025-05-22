<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CleaningResource extends JsonResource
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
				else{
					$actions['d'] = ['title' => '<i class="ph ph-check"></i>', 'action' => 'toggleObjectStatus', 'class' => 'btn-success', 'additional_params' => [1], 'hint' => 'Activate'];
				}
			}
			$actions['p'] = ['title' => '<i class="ph ph-printer"></i>', 'action' => 'printObject', 'class' => 'btn-primary', 'hint' => 'Print'];
		}
		return [
			'id' => $this->id,
			'company_id' => $this->company_id,
			'ref_no' => $this->ref_no,
			'tank_type_id' => $this->tank_type_id,
			'tank_no' => $this->tank_no,
			'tcode_id' => $this->tcode_id,
			'customer_id' => $this->customer_id,
			'csc' => $this->csc,
			'mfgt_date' => $this->mfgt_date,
			'last_inspection_date' => $this->last_inspection_date,
			'mgw' => $this->mgw,
			'next_date' => $this->next_date,
			'capacity' => $this->capacity,
			'tare_wt' => $this->tare_wt,
			'inspection_locn' => $this->inspection_locn,
			'inspection_date' => $this->inspection_date,
			// 'client_id' => $this->client_id,
			'cleaning_location_id' => $this->cleaning_location_id,
			'last_cargo_carried' => $this->last_cargo_carried,
			'surveyor_id' => $this->surveyor_id,
			'frame_tank' => $this->frame_tank,
			'manlid_valves' => $this->manlid_valves,
			'serial_nos' => $this->serial_nos,
			'labels_removed' => $this->labels_removed,
			'entry' => $this->entry,
			'odour_free' => $this->odour_free,
			'clean_free' => $this->clean_free,
			'corrosion_free' => $this->corrosion_free,
			'dry' => $this->dry,
			'valves' => $this->valves,
			'manlid_seal' => $this->manlid_seal,
			'gas_free' => $this->gas_free,
			'siphon' => $this->siphon,
			'remarks' => $this->remarks,
			'interior' => $this->interior,
			'exterior' => $this->exterior,
			'sealno' => $this->sealno,
			'created_by' => $this->created_by,
			'company' => $this->company,
			'tank' => $this->tank,
			'tcode' => $this->tcode,
			'customer' => $this->customer,
			'inspectionlocation' => $this->inspectionlocation,
			// 'client' => $this->client,
			'cleaninglocation' => $this->cleaninglocation,
			'surveyor' => $this->surveyor,
			'creator' => $this->creator,
			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}

}
