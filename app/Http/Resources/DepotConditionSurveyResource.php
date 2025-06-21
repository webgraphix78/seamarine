<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ActionsService;

class DepotConditionSurveyResource extends JsonResource
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
			$actions = ActionsService::generateActions(\App\Models\DepotConditionSurvey::class, $currentUser->role_id, $this->status);
		};
		return [
			'id' => $this->id,
			'tank_no' => $this->tank_no,
			'ref_no' => $this->ref_no,
			'company_id' => $this->company_id,
			'rel_company_id' => $this->rel_company_id,
			'inspection_date' => $this->inspection_date,
			'mfg_sr_no' => $this->mfg_sr_no,
			'last_test_date' => $this->last_test_date,
			'customer_id' => $this->customer_id,
			'rel_customer_id' => $this->rel_customer_id,
			'mgw' => $this->mgw,
			'tare_wt' => $this->tare_wt,
			'iso_type' => $this->iso_type,
			'capacity' => $this->capacity,
			'inspection_location_id' => $this->inspection_location_id,
			'rel_inspection_location_id' => $this->rel_inspection_location_id,
			'date_of_mfg' => $this->date_of_mfg,
			'mfg' => $this->mfg,
			'next_inspection_date' => $this->next_inspection_date,
			'protection_cover' => $this->protection_cover,
			'manhole_cover_fastening_bolts' => $this->manhole_cover_fastening_bolts,
			'top_safety_valve_sr_no' => $this->top_safety_valve_sr_no,
			'top_safety_valve' => $this->top_safety_valve,
			'rupture_disc_series' => $this->rupture_disc_series,
			'dipping_pipe' => $this->dipping_pipe,
			'air_valve' => $this->air_valve,
			'air_valve_label' => $this->air_valve_label,
			'top_loading_label' => $this->top_loading_label,
			'dipstick' => $this->dipstick,
			'manhole_gasket_type' => $this->manhole_gasket_type,
			'manhole_gasket' => $this->manhole_gasket,
			'walkway' => $this->walkway,
			'top_loading' => $this->top_loading,
			'top_loading_flange' => $this->top_loading_flange,
			'heating_plug_pipe' => $this->heating_plug_pipe,
			'heating_pipe_covers' => $this->heating_pipe_covers,
			'bottom_outlet_valve' => $this->bottom_outlet_valve,
			'bottom_valve_cap' => $this->bottom_valve_cap,
			'bottom_valve_bolts_nuts' => $this->bottom_valve_bolts_nuts,
			'bottom_valve_lever' => $this->bottom_valve_lever,
			'ladder' => $this->ladder,
			'document_box' => $this->document_box,
			'thermometer_temp' => $this->thermometer_temp,
			'thermometer' => $this->thermometer,
			'remote_shut_off' => $this->remote_shut_off,
			'hand_rail' => $this->hand_rail,
			'rust' => $this->rust,
			'discolouration' => $this->discolouration,
			'surface_scoring' => $this->surface_scoring,
			'pitting_surface_pin' => $this->pitting_surface_pin,
			'corrosion_mark' => $this->corrosion_mark,
			'others' => $this->others,
			'framework_front_end' => $this->framework_front_end,
			'cladding_front_end' => $this->cladding_front_end,
			'framework_rare_end' => $this->framework_rare_end,
			'cladding_rare_end' => $this->cladding_rare_end,
			'framework_right_side' => $this->framework_right_side,
			'cladding_right_side' => $this->cladding_right_side,
			'framework_left_side' => $this->framework_left_side,
			'cladding_left_side' => $this->cladding_left_side,
			'framework_top' => $this->framework_top,
			'cladding_top' => $this->cladding_top,
			'framework_bottom' => $this->framework_bottom,
			'cladding_bottom' => $this->cladding_bottom,
			'exterior_remarks' => $this->exterior_remarks,
			'liquid_tank_no' => $this->liquid_tank_no,
			'liquid_inspection_date' => $this->liquid_inspection_date,
			'liquid_inspection_location_id' => $this->liquid_inspection_location_id,
			'rel_liquid_inspection_location_id' => $this->rel_liquid_inspection_location_id,
			'liquid_img' => $this->liquid_img,
			'remarks' => $this->remarks,
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
