<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ActionsService;

class DmccResource extends JsonResource
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
			$actions = ActionsService::generateActions(\App\Models\Dmcc::class, $currentUser->role_id, $this->status);
		};
		return [
			'id' => $this->id,
			'tank_no' => $this->tank_no,
			'company_id' => $this->company_id,
			'rel_company_id' => $this->rel_company_id,
			'inspection_date' => $this->inspection_date,
			'loading_of' => $this->loading_of,
			'seals_intact_time' => $this->seals_intact_time,
			'seals_intact_remark' => $this->seals_intact_remark,
			'seals_broken' => $this->seals_broken,
			'pretrip_inspection_qc' => $this->pretrip_inspection_qc,
			'bottom_valve_checked' => $this->bottom_valve_checked,
			'n2_released_dn40' => $this->n2_released_dn40,
			'emergency_remote_checked' => $this->emergency_remote_checked,
			'manlid_checked' => $this->manlid_checked,
			'manlid_valve_closed' => $this->manlid_valve_closed,
			'tank_cleared_for_purging' => $this->tank_cleared_for_purging,
			'dn80_connector_fitted' => $this->dn80_connector_fitted,
			'n2_purged_1' => $this->n2_purged_1,
			'n2_released_1' => $this->n2_released_1,
			'n2_purged_2' => $this->n2_purged_2,
			'n2_released_2' => $this->n2_released_2,
			'n2_purged_3' => $this->n2_purged_3,
			'n2_released_3' => $this->n2_released_3,
			'qc_permission_granted' => $this->qc_permission_granted,
			'bscl_pumping_started' => $this->bscl_pumping_started,
			'dn40_opened_during_loading' => $this->dn40_opened_during_loading,
			'loading_completed_dn40_closed' => $this->loading_completed_dn40_closed,
			'butterfly_valve_closed' => $this->butterfly_valve_closed,
			'cargo_sample_removed' => $this->cargo_sample_removed,
			'butterfly_valve_reclosed' => $this->butterfly_valve_reclosed,
			'n2_purged_final' => $this->n2_purged_final,
			'final_inspection_done' => $this->final_inspection_done,
			'n2_cylinder_nos' => $this->n2_cylinder_nos,
			'total_no_cylinder' => $this->total_no_cylinder,
			'bscl_rep' => $this->bscl_rep,
			'surveyor_id' => $this->surveyor_id,
			'rel_surveyor_id' => $this->rel_surveyor_id,
			'status' => $this->status,
			'deleted_at' => $this->deleted_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,

			'current_user_admin' => ( $currentUser->role_id ? 1 : 0 ),
			'actions' => $actions
		];
    }
}
