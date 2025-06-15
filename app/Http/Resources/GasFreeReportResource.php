<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ActionsService;

class GasFreeReportResource extends JsonResource
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
			$actions = ActionsService::generateActions(\App\Models\GasFreeReport::class, $currentUser->role_id, $this->status);
		};
		return [
			'id' => $this->id,
			'tank_no' => $this->tank_no,
			'company_id' => $this->company_id,
			'rel_company_id' => $this->rel_company_id,
			'type' => $this->type,
			'ref_no' => $this->ref_no,
			'csc_no' => $this->csc_no,
			'mfg' => $this->mfg,
			'ned' => $this->ned,
			'mgw' => $this->mgw,
			'tare_wt' => $this->tare_wt,
			'capacity' => $this->capacity,
			'inspection_date' => $this->inspection_date,
			'inspection_location_id' => $this->inspection_location_id,
			'rel_inspection_location_id' => $this->rel_inspection_location_id,
			'customer_id' => $this->customer_id,
			'rel_customer_id' => $this->rel_customer_id,
			'last_cargo_carried' => $this->last_cargo_carried,
			'lel_inst' => $this->lel_inst,
			'lel_sr_no' => $this->lel_sr_no,
			'calibration_validity_dt' => $this->calibration_validity_dt,
			'calibration_sr_no' => $this->calibration_sr_no,
			'oxygen_mtr' => $this->oxygen_mtr,
			'oxy_calibration_validity' => $this->oxy_calibration_validity,
			'in_air_lel' => $this->in_air_lel,
			'in_air_oxygen' => $this->in_air_oxygen,
			'in_space_lel' => $this->in_space_lel,
			'in_space_oxygen' => $this->in_space_oxygen,
			'reacted_to_hydrocarbon' => $this->reacted_to_hydrocarbon,
			'alarmed_at' => $this->alarmed_at,
			'tank_is_gas_free' => $this->tank_is_gas_free,
			'surveyor_id' => $this->surveyor_id,
			'rel_surveyor_id' => $this->rel_surveyor_id,
			'deleted_at' => $this->deleted_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
			'current_user_admin' => ( $currentUser->role_id ? 1 : 0 ),
			'actions' => $actions
		];
    }
}
