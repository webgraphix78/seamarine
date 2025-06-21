<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ActionsService;

class SmTestingFieldResource extends JsonResource
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
			$actions = ActionsService::generateActions(\App\Models\SmTestingField::class, $currentUser->role_id, $this->status);
		};
		return [
			'id' => $this->id,
			'company_id' => $this->company_id,
			'rel_company_id' => $this->rel_company_id,
			'inspection_date' => $this->inspection_date,
			'inspection_location_id' => $this->inspection_location_id,
			'rel_inspection_location_id' => $this->rel_inspection_location_id,
			'operator_lessor' => $this->operator_lessor,
			'tank_no' => $this->tank_no,
			'mfg' => $this->mfg,
			'mfg_sr_no' => $this->mfg_sr_no,
			'csc' => $this->csc,
			'uk_dot' => $this->uk_dot,
			'imdg' => $this->imdg,
			'us_dot' => $this->us_dot,
			'rid' => $this->rid,
			'aar' => $this->aar,
			'bam' => $this->bam,
			'tc_impact' => $this->tc_impact,
			'tir' => $this->tir,
			'uic' => $this->uic,
			'fra' => $this->fra,
			'tank_mfg_year' => $this->tank_mfg_year,
			'tank_max_g_wt' => $this->tank_max_g_wt,
			'tank_tare_wt' => $this->tank_tare_wt,
			'tank_capacity' => $this->tank_capacity,
			'tank_desgin_temp' => $this->tank_desgin_temp,
			'tank_mawp_bar' => $this->tank_mawp_bar,
			'tank_test_press_bar' => $this->tank_test_press_bar,
			'tank_top_discharge' => $this->tank_top_discharge,
			'tank_bottom_discharge' => $this->tank_bottom_discharge,
			'tank_no_of_closure' => $this->tank_no_of_closure,
			'tank_shell_material' => $this->tank_shell_material,
			'tank_shell_thickness' => $this->tank_shell_thickness,
			'tank_heads_material' => $this->tank_heads_material,
			'tank_head_thickness' => $this->tank_head_thickness,
			'tank_iso_type' => $this->tank_iso_type,
			'insp_init_hydro_date' => $this->insp_init_hydro_date,
			'insp_hydro_witness' => $this->insp_hydro_witness,
			'insp_last_hydro_date' => $this->insp_last_hydro_date,
			'insp_last_hydro_witness' => $this->insp_last_hydro_witness,
			'insp_date' => $this->insp_date,
			'next_insp_date' => $this->next_insp_date,
			'insp_inter_perfom_na' => $this->insp_inter_perfom_na,
			'insp_inter_perfom_in' => $this->insp_inter_perfom_in,
			'insp_inter_perfom_remark' => $this->insp_inter_perfom_remark,
			'insp_ext_perfom_na' => $this->insp_ext_perfom_na,
			'insp_ext_perfom_in' => $this->insp_ext_perfom_in,
			'insp_ext_perfom_remark' => $this->insp_ext_perfom_remark,
			'insp_perfom_date_na' => $this->insp_perfom_date_na,
			'insp_perfom_date_in' => $this->insp_perfom_date_in,
			'insp_perfom_date_remark' => $this->insp_perfom_date_remark,
			'insp_perfom_pressure_bar_na' => $this->insp_perfom_pressure_bar_na,
			'insp_perfom_pressure_bar_in' => $this->insp_perfom_pressure_bar_in,
			'insp_perfom_pressure_bar_remark' => $this->insp_perfom_pressure_bar_remark,
			'insp_perfom_fittin_na' => $this->insp_perfom_fittin_na,
			'insp_perfom_fittin_in' => $this->insp_perfom_fittin_in,
			'insp_perfom_fittin_remark' => $this->insp_perfom_fittin_remark,
			'insp_perfom_frame_na' => $this->insp_perfom_frame_na,
			'insp_perfom_frame_in' => $this->insp_perfom_frame_in,
			'insp_perfom_frame_remark' => $this->insp_perfom_frame_remark,
			'insp_perfom_decals_na' => $this->insp_perfom_decals_na,
			'insp_perfom_decals_in' => $this->insp_perfom_decals_in,
			'insp_perfom_decals_remark' => $this->insp_perfom_decals_remark,
			'insp_perfom_steam_na' => $this->insp_perfom_steam_na,
			'insp_perfom_steam_in' => $this->insp_perfom_steam_in,
			'insp_perfom_steam_remark' => $this->insp_perfom_steam_remark,
			'p_mfgr_type_1' => $this->p_mfgr_type_1,
			'p_mfgr_type_2' => $this->p_mfgr_type_2,
			'p_sr_no_1' => $this->p_sr_no_1,
			'p_sr_no_2' => $this->p_sr_no_2,
			'p_full_flow_rate_1' => $this->p_full_flow_rate_1,
			'p_full_flow_rate_2' => $this->p_full_flow_rate_2,
			'p_operating_press_1' => $this->p_operating_press_1,
			'p_operating_press_2' => $this->p_operating_press_2,
			'p_vacuum_setting_1' => $this->p_vacuum_setting_1,
			'p_vacuum_setting_2' => $this->p_vacuum_setting_2,
			'p_bursting_disc_1' => $this->p_bursting_disc_1,
			'p_bursting_disc_2' => $this->p_bursting_disc_2,
			'platemark' => $this->platemark,
			'comments' => $this->comments,
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
