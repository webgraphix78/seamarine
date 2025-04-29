<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ShipperSurveyResource extends JsonResource
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
			'survey_date' => $this->survey_date,
			'company_id' => $this->company_id,
			'last_cargo_carried' => $this->last_cargo_carried,
			'tank_container_no' => $this->tank_container_no,
			'surveyor_id' => $this->surveyor_id,
			'for_shipper_id' => $this->for_shipper_id,
			'customer_id' => $this->customer_id,
			'csc_no' => $this->csc_no,
			'type' => $this->type,
			'inspection_location_id' => $this->inspection_location_id,
			'mfg_date' => $this->mfg_date,
			'last_inspection_date' => $this->last_inspection_date,
			'capacity' => $this->capacity,
			'next_date' => $this->next_date,
			// 'ref' => $this->ref,
			'gross_wt' => $this->gross_wt,
			'tare_wt' => $this->tare_wt,
			'frame_tank' => $this->frame_tank,
			'manlid_valve' => $this->manlid_valve,
			'serial_nos' => $this->serial_nos,
			'steam_jacket' => $this->steam_jacket,
			'bullet_seal' => $this->bullet_seal,
			'gasket_type' => $this->gasket_type,
			'manlid_cover' => $this->manlid_cover,
			'distick' => $this->distick,
			'calibration' => $this->calibration,
			'siphon_tube' => $this->siphon_tube,
			'pressure_gauge' => $this->pressure_gauge,
			'temperature_gauge' => $this->temperature_gauge,
			'prv_poppet' => $this->prv_poppet,
			'top_provision' => $this->top_provision,
			'interior_clean' => $this->interior_clean,
			'valves_free' => $this->valves_free,
			'non_transferable' => $this->non_transferable,
			'polish_buffing' => $this->polish_buffing,
			'note' => $this->note,
			'manlid_seal_no' => $this->manlid_seal_no,
			'airline_seal_no' => $this->airline_seal_no,
			'bottom_seal_no' => $this->bottom_seal_no,
			'top_seal' => $this->top_seal,
			'created_by' => $this->created_by,
			'company' => $this->company,
			'surveyor' => $this->surveyor,
			'for_shipper' => $this->for_shipper,
			'customer' => $this->customer,
			'inspection_location' => $this->inspection_location,
			'creator' => $this->creator,

			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}
}
