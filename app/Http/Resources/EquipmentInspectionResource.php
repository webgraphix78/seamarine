<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ActionsService;

class EquipmentInspectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array{
		$input = $request->all();
		$actions = [];
		
		if (isset($input['current_user_id']) && $input['current_user_id'] > 0) {
			$currentUser = \App\Models\User::find($input['current_user_id']);
			$actions = ActionsService::generateActions(\App\Models\EquipmentInspection::class, $currentUser->role_id, $this->status);
		};
		return [
			'id' => $this->id,
			'ref_no' => $this->ref_no,
			'company_id' => $this->company_id,
			'rel_company_id' => $this->rel_company_id,
			'inspection_date' => $this->inspection_date,
			'tank_no' => $this->tank_no,
			'last_cargo_carried' => $this->last_cargo_carried,
			'empty_clean' => $this->empty_clean,
			'empty_dirty' => $this->empty_dirty,
			'loaded' => $this->loaded,
			'surveyor_id' => $this->surveyor_id,
			'rel_surveyor_id' => $this->rel_surveyor_id,
			'hazard_class' => $this->hazard_class,
			'eq_inspection_status' => $this->eq_inspection_status,
			'last_test_date' => $this->last_test_date,
			'capacity' => $this->capacity,
			'equipment_type' => $this->equipment_type,
			'csc' => $this->csc,
			'loaded_at' => $this->loaded_at,
			'tank_type' => $this->tank_type,
			'mfg_date' => $this->mfg_date,
			'cfs' => $this->cfs,
			'for_id' => $this->for_id,
			'rel_for_id' => $this->rel_for_id,
			'next_date' => $this->next_date,
			'country' => $this->country,
			'inspection_location_id' => $this->inspection_location_id,
			'rel_inspection_location_id' => $this->rel_inspection_location_id,
			'customer_id' => $this->customer_id,
			'rel_customer_id' => $this->rel_customer_id,
			'cha_client' => $this->cha_client,
			'tare_weight' => $this->tare_weight,
			'mgw' => $this->mgw,
			'bottom_discharge_tir' => $this->bottom_discharge_tir,
			'bottom_discharge_seal' => $this->bottom_discharge_seal,
			'bottom_discharge_comments' => $this->bottom_discharge_comments,
			'manlid_tir' => $this->manlid_tir,
			'manlid_seal' => $this->manlid_seal,
			'manlid_comments' => $this->manlid_comments,
			'airline_value_tir' => $this->airline_value_tir,
			'airline_value_seal' => $this->airline_value_seal,
			'airline_value_comments' => $this->airline_value_comments,
			'prv_tir' => $this->prv_tir,
			'prv_seal' => $this->prv_seal,
			'prv_comments' => $this->prv_comments,
			'top_discharge_tir' => $this->top_discharge_tir,
			'top_discharge_seal' => $this->top_discharge_seal,
			'top_discharge_comments' => $this->top_discharge_comments,
			'to_discharge_fill_flange_tir' => $this->to_discharge_fill_flange_tir,
			'to_discharge_fill_flange_seal' => $this->to_discharge_fill_flange_seal,
			'to_discharge_fill_flange_comments' => $this->to_discharge_fill_flange_comments,
			'safety_provision_tir' => $this->safety_provision_tir,
			'safety_provision_seal' => $this->safety_provision_seal,
			'safety_provision_comments' => $this->safety_provision_comments,
			'vapour_return_provision_tir' => $this->vapour_return_provision_tir,
			'vapour_return_provision_seal' => $this->vapour_return_provision_seal,
			'vapour_return_provision_comments' => $this->vapour_return_provision_comments,
			'fwd_inspection_hatch_tir' => $this->fwd_inspection_hatch_tir,
			'fwd_inspection_hatch_seal' => $this->fwd_inspection_hatch_seal,
			'fwd_inspection_hatch_comments' => $this->fwd_inspection_hatch_comments,
			'afg_inspection_hatch_tir' => $this->afg_inspection_hatch_tir,
			'afg_inspection_hatch_seal' => $this->afg_inspection_hatch_seal,
			'afg_inspection_hatch_comments' => $this->afg_inspection_hatch_comments,
			'comments' => $this->comments,
			'deleted_at' => $this->deleted_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,

			'current_user_admin' => 1,
			'actions' => $actions
		];
    }
}
