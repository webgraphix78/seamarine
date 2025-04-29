<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Imo1Resource extends JsonResource
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
			'company_id' => $this->company_id,
			'inspection_date' => $this->inspection_date,
			'csc' => $this->csc,
			'loaded_at' => $this->loaded_at,
			'tank_type_id' => $this->tank_type_id,
			'tank_no' => $this->tank_no,
			'tcode_id' => $this->tcode_id,
			'last_cargo_carried' => $this->last_cargo_carried,
			'mfgt_date' => $this->mfgt_date,
			'empty_clean' => $this->empty_clean,
			'empty_dirty' => $this->empty_dirty,
			'cfs' => $this->cfs,
			'for_client' => $this->for_client,
			'loaded' => $this->loaded,
			'next_date' => $this->next_date,
			'surveyor_id' => $this->surveyor_id,
			'country' => $this->country,
			'hazard_class' => $this->hazard_class,
			'inspection_location_id' => $this->inspection_location_id,
			'customer_id' => $this->customer_id,
			'cha_client' => $this->cha_client,
			'imo1_status' => $this->imo1_status,
			'walkway_image' => $this->walkway_image, 
			'last_inspection_date' => $this->last_inspection_date,
			'front_panel_cladding' => $this->front_panel_cladding,
			'front_panel_decals' => $this->front_panel_decals,
			'rear_panel_cladding' => $this->rear_panel_cladding,
			'rear_panel_decals' => $this->rear_panel_decals,
			'right_side_cladding' => $this->right_side_cladding,
			'right_side_decals' => $this->right_side_decals,
			'left_side_cladding' => $this->left_side_cladding,
			'left_side_decals' => $this->left_side_decals,
			'top_cladding' => $this->top_cladding,
			'top_decals' => $this->top_decals,
			'underside_cladding' => $this->underside_cladding,
			'underside_decals' => $this->underside_decals,
			'front_end_damage' => $this->front_end_damage,
			'rear_end_damage' => $this->rear_end_damage,
			'right_side_damage' => $this->right_side_damage,
			'left_side_damage' => $this->left_side_damage,
			'top_damage' => $this->top_damage,
			'underside_damage' => $this->underside_damage,
			'exterior_wash_needed' => $this->exterior_wash_needed,
			'rusty_frame' => $this->rusty_frame,
			'patchy_cladding' => $this->patchy_cladding,
			'product_spills' => $this->product_spills,
			'renew_logo' => $this->renew_logo,
			'previous_haz' => $this->previous_haz,
			'ladder_nos' => $this->ladder_nos,
			'ladder_cond_status_id' => $this->ladder_cond_status_id,
			'document_box_nos' => $this->document_box_nos,
			'document_box_cond_status_id' => $this->document_box_cond_status_id,
			'temperature_gauge_nos' => $this->temperature_gauge_nos,
			'temperature_gauge_cond_status_id' => $this->temperature_gauge_cond_status_id,
			'steam_nos' => $this->steam_nos,
			'steam_cond_status_id' => $this->steam_cond_status_id,
			'steam_pressure_nos' => $this->steam_pressure_nos,
			'steam_pressure_cond_status_id' => $this->steam_pressure_cond_status_id,
			'remote_system_nos' => $this->remote_system_nos,
			'remote_system_cond_status_id' => $this->remote_system_cond_status_id,
			'electrical_heating_nos' => $this->electrical_heating_nos,
			'electrical_heating_cond_status_id' => $this->electrical_heating_cond_status_id,
			'manlid_nos' => $this->manlid_nos,
			'manlid_cond_status_id' => $this->manlid_cond_status_id,
			'manlid_swing_nos' => $this->manlid_swing_nos,
			'manlid_swing_cond_status_id' => $this->manlid_swing_cond_status_id,
			'insp_hatch_nos' => $this->insp_hatch_nos,
			'insp_hatch_cond_status_id' => $this->insp_hatch_cond_status_id,
			'insp_hatch_swing_bolt_no' => $this->insp_hatch_swing_bolt_no,
			'insp_hatch_swing_bolt_cond_status_id' => $this->insp_hatch_swing_bolt_cond_status_id,
			'spill_box_nos' => $this->spill_box_nos,
			'spill_box_cond_status_id' => $this->spill_box_cond_status_id,
			'pre_valve_nos' => $this->pre_valve_nos,
			'pre_valve_cond_status_id' => $this->pre_valve_cond_status_id,
			'pre_bursting_disc_nos' => $this->pre_bursting_disc_nos,
			'pre_bursting_disc_cond_status_id' => $this->pre_bursting_disc_cond_status_id,
			'walkyway_ls_nos' => $this->walkyway_ls_nos,
			'walkyway_ls_cond_status_id' => $this->walkyway_ls_cond_status_id,
			'walkyway_scs_nos' => $this->walkyway_scs_nos,
			'walkyway_scs_cond_status_id' => $this->walkyway_scs_cond_status_id,
			'walkyway_mls_nos' => $this->walkyway_mls_nos,
			'walkyway_mls_cond_status_id' => $this->walkyway_mls_cond_status_id,
			'airline_valve_nos' => $this->airline_valve_nos,
			'airline_valve_cond_status_id' => $this->airline_valve_cond_status_id,
			'tank_gauge_nos' => $this->tank_gauge_nos,
			'tank_gauge_cond_status_id' => $this->tank_gauge_cond_status_id,
			'dipstick_nos' => $this->dipstick_nos,
			'dipstick_cond_status_id' => $this->dipstick_cond_status_id,
			'calibration_chart_nos' => $this->calibration_chart_nos,
			'calibration_chart_cond_status_id' => $this->calibration_chart_cond_status_id,
			'syphon_pipe_nos' => $this->syphon_pipe_nos,
			'syphon_pipe_cond_status_id' => $this->syphon_pipe_cond_status_id,
			'b_fly_valve_nos' => $this->b_fly_valve_nos,
			'b_fly_valve_cond_status_id' => $this->b_fly_valve_cond_status_id,
			'blank_flange_nos' => $this->blank_flange_nos,
			'blank_flange_cond_status_id' => $this->blank_flange_cond_status_id,
			'top_vapour_nos' => $this->top_vapour_nos,
			'top_vapour_cond_status_id' => $this->top_vapour_cond_status_id,
			'top_vapour_bolts_nos' => $this->top_vapour_bolts_nos,
			'top_vapour_bolts_cond_status_id' => $this->top_vapour_bolts_cond_status_id,
			'flanged_provision_nos' => $this->flanged_provision_nos,
			'flanged_provision_cond_status_id' => $this->flanged_provision_cond_status_id,
			'bottom_foot_nos' => $this->bottom_foot_nos,
			'bottom_foot_cond_status_id' => $this->bottom_foot_cond_status_id,
			'bottom_bfly_nos' => $this->bottom_bfly_nos,
			'bottom_bfly_cond_status_id' => $this->bottom_bfly_cond_status_id,
			'bottom_outlet_flange_nos' => $this->bottom_outlet_flange_nos,
			'bottom_outlet_flange_cond_status_id' => $this->bottom_outlet_flange_cond_status_id,
			'bottom_valve_handle_nos' => $this->bottom_valve_handle_nos,
			'bottom_valve_handle_cond_status_id' => $this->bottom_valve_handle_cond_status_id,
			'bottom_bfly_ball_nos' => $this->bottom_bfly_ball_nos,
			'bottom_bfly_ball_cond_status_id' => $this->bottom_bfly_ball_cond_status_id,
			'fusible_link_no' => $this->fusible_link_no,
			'fusible_link_cond_status_id' => $this->fusible_link_cond_status_id,
			'camera' => $this->camera,
			'gps' => $this->gps,
			'last_test_date' => $this->last_test_date,
			'tare_wt' => $this->tare_wt,
			'capacity' => $this->capacity,
			'mgw' => $this->mgw,
			'comments' => $this->comments,
			'created_by' => $this->created_by,
			'tanktype' => $this->tanktype,
			'tcode' => $this->tcode,
			'for_client' => $this->for_client,
			'surveyor' => $this->surveyor,
			'inspection_location' => $this->inspection_location,
			'customer' => $this->customer,
			'ladder_cond_status' => $this->ladder_cond_status,
			'document_box_cond_status' => $this->document_box_cond_status,
			'temperature_gauge_cond_status' => $this->temperature_gauge_cond_status,
			'steam_cond_status' => $this->steam_cond_status,
			'steam_pressure_cond_status' => $this->steam_pressure_cond_status,
			'remote_system_cond_status' => $this->remote_system_cond_status,
			'electrical_heating_cond_status' => $this->electrical_heating_cond_status,
			'manlid_cond_status' => $this->manlid_cond_status,
			'manlid_swing_cond_status' => $this->manlid_swing_cond_status,
			'insp_hatch_cond_status' => $this->insp_hatch_cond_status,
			'insp_hatch_swing_bolt_cond_status' => $this->insp_hatch_swing_bolt_cond_status,
			'spill_box_cond_status' => $this->spill_box_cond_status,
			'pre_valve_cond_status' => $this->pre_valve_cond_status,
			'pre_bursting_disc_cond_status' => $this->pre_bursting_disc_cond_status,
			'walkyway_ls_cond_status' => $this->walkyway_ls_cond_status,
			'walkyway_scs_cond_status' => $this->walkyway_scs_cond_status,
			'walkyway_mls_cond_status' => $this->walkyway_mls_cond_status,
			'airline_valve_cond_status' => $this->airline_valve_cond_status,
			'tank_gauge_cond_status' => $this->tank_gauge_cond_status,
			'dipstick_cond_status' => $this->dipstick_cond_status,
			'calibration_chart_cond_status' => $this->calibration_chart_cond_status,
			'syphon_pipe_cond_status' => $this->syphon_pipe_cond_status,
			'bfly_valve_cond_status' => $this->bfly_valve_cond_status,
			'blank_flange_cond_status' => $this->blank_flange_cond_status,
			'top_vapour_cond_status' => $this->top_vapour_cond_status,
			'top_vapour_bolts_cond_status' => $this->top_vapour_bolts_cond_status,
			'flanged_provision_cond_status' => $this->flanged_provision_cond_status,
			'bottom_foot_cond_status' => $this->bottom_foot_cond_status,
			'bottom_bfly_cond_status' => $this->bottom_bfly_cond_status,
			'bottom_outlet_flange_cond_status' => $this->bottom_outlet_flange_cond_status,
			'bottom_valve_handle_cond_status' => $this->bottom_valve_handle_cond_status,
			'bottom_bfly_ball_cond_status' => $this->bottom_bfly_ball_cond_status,
			'fusible_link_cond_status' => $this->fusible_link_cond_status,
			'creator' => $this->creator,
			'company' => $this->company,
			'for_client_rec' => $this->for_client_rec,
			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}
}
