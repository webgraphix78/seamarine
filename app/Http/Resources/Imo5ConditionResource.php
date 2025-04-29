<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Imo5ConditionResource extends JsonResource
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
			'container_no' => $this->container_no,
			'tank_type_id' => $this->tank_type_id,
			'tcode_id' => $this->tcode_id,
			'client' => $this->client,
			'capacity' => $this->capacity,
			'mfgt_date' => $this->mfgt_date,
			'gross_wt' => $this->gross_wt,
			'csc' => $this->csc,
			'inspection_location_id' => $this->inspection_location_id,
			'next_date' => $this->next_date,
			'tare_wt' => $this->tare_wt,
			'imo_status' => $this->imo_status,
			'sealed' => $this->sealed,
			'cleaning_location_id' => $this->cleaning_location_id,
			'survey_date' => $this->survey_date,
			'customer_id' => $this->customer_id,
			'refno' => $this->refno,
			'scover' => $this->scover,
			'bvboxyn' => $this->bvboxyn,
			'bvboxsu' => $this->bvboxsu,
			'comments' => $this->comments,
			'markings_fitted_yes' => $this->markings_fitted_yes,
			'markings_condition_good' => $this->markings_condition_good,
			'marking_plates' => $this->marking_plates,
			'data_fitted_yes' => $this->data_fitted_yes,
			'data_condition_good' => $this->data_condition_good,
			'data_plate' => $this->data_plate,
			'owners_plate_yes' => $this->owners_plate_yes,
			'owners_plate_good' => $this->owners_plate_good,
			'owners_plate' => $this->owners_plate,
			'manufactures_plate_yes' => $this->manufactures_plate_yes,
			'manufactures_plate_good' => $this->manufactures_plate_good,
			'manufactures_plates' => $this->manufactures_plates,
			'csc_plate_yes' => $this->csc_plate_yes,
			'csc_plate_good' => $this->csc_plate_good,
			'csc_plate' => $this->csc_plate,
			'customs_plate_yes' => $this->customs_plate_yes,
			'customs_plate_good' => $this->customs_plate_good,
			'customs_plate' => $this->customs_plate,
			'prefix_yes' => $this->prefix_yes,
			'prefix_good' => $this->prefix_good,
			'prefix' => $this->prefix,
			'imo_yes' => $this->imo_yes,
			'imo_good' => $this->imo_good,
			'imo' => $this->imo,
			'country_code_yes' => $this->country_code_yes,
			'country_code_good' => $this->country_code_good,
			'country_code' => $this->country_code,
			'rear_ladder_yes' => $this->rear_ladder_yes,
			'rear_ladder_good' => $this->rear_ladder_good,
			'front_ladder' => $this->front_ladder,
			'document_box_yes' => $this->document_box_yes,
			'document_box_good' => $this->document_box_good,
			'document_box' => $this->document_box,
			'outlet_yes' => $this->outlet_yes,
			'outlet_good' => $this->outlet_good,
			'outlet' => $this->outlet,
			'bottom_outlet_yes' => $this->bottom_outlet_yes,
			'bottom_outlet_good' => $this->bottom_outlet_good,
			'bottom_outlet' => $this->bottom_outlet,
			'foot_valve_yes' => $this->foot_valve_yes,
			'foot_valve_good' => $this->foot_valve_good,
			'foot_valve' => $this->foot_valve,
			'remote_footvalve_yes' => $this->remote_footvalve_yes,
			'remote_footvalve_good' => $this->remote_footvalve_good,
			'remote_footvalve' => $this->remote_footvalve,
			'steam_tubes_yes' => $this->steam_tubes_yes,
			'steam_tubes_good' => $this->steam_tubes_good,
			'steam_tubes' => $this->steam_tubes,
			'condensate_drains_yes' => $this->condensate_drains_yes,
			'condensate_drains_good' => $this->condensate_drains_good,
			'condensate_drains' => $this->condensate_drains,
			'thermometer_yes' => $this->thermometer_yes,
			'thermometer_good' => $this->thermometer_good,
			'thermometer' => $this->thermometer,
			'walkway_yes' => $this->walkway_yes,
			'walkway_good' => $this->walkway_good,
			'walkway' => $this->walkway,
			'manlid_protection_yes' => $this->manlid_protection_yes,
			'manlid_protection_good' => $this->manlid_protection_good,
			'manlid_protection' => $this->manlid_protection,
			'spillbox_yes' => $this->spillbox_yes,
			'spillbox_good' => $this->spillbox_good,
			'spillbox' => $this->spillbox,
			'manlid_yes' => $this->manlid_yes,
			'manlid_good' => $this->manlid_good,
			'manlid' => $this->manlid,
			'manlid_bolts_yes' => $this->manlid_bolts_yes,
			'manlid_bolts_good' => $this->manlid_bolts_good,
			'manlid_bolts' => $this->manlid_bolts,
			'dipstick_yes' => $this->dipstick_yes,
			'dipstick_good' => $this->dipstick_good,
			'dipstick' => $this->dipstick,
			'safety_cover_yes' => $this->safety_cover_yes,
			'safety_cover_good' => $this->safety_cover_good,
			'safety_cover' => $this->safety_cover,
			'calibration_chart_yes' => $this->calibration_chart_yes,
			'calibration_chart_good' => $this->calibration_chart_good,
			'calibration_chart' => $this->calibration_chart,
			'relief_valves_yes' => $this->relief_valves_yes,
			'relief_valves_good' => $this->relief_valves_good,
			'relief_valves' => $this->relief_valves,
			'pressure_gauges_yes' => $this->pressure_gauges_yes,
			'pressure_gauges_good' => $this->pressure_gauges_good,
			'pressure_gauges' => $this->pressure_gauges,
			'flame_traps_yes' => $this->flame_traps_yes,
			'flame_traps_good' => $this->flame_traps_good,
			'flame_traps' => $this->flame_traps,
			'air_line_cap_yes' => $this->air_line_cap_yes,
			'air_line_cap_good' => $this->air_line_cap_good,
			'air_line_cap' => $this->air_line_cap,
			'air_line_valve_yes' => $this->air_line_valve_yes,
			'air_line_valve_good' => $this->air_line_valve_good,
			'air_line_valve' => $this->air_line_valve,
			'top_disch_prot_yes' => $this->top_disch_prot_yes,
			'top_disch_prot_good' => $this->top_disch_prot_good,
			'top_disch_prot' => $this->top_disch_prot,
			'top_disch_valve_yes' => $this->top_disch_valve_yes,
			'top_disch_valve_good' => $this->top_disch_valve_good,
			'top_disch_valve' => $this->top_disch_valve,
			'top_condition_yes' => $this->top_condition_yes,
			'top_condition_good' => $this->top_condition_good,
			'top_condition' => $this->top_condition,
			'created_by' => $this->created_by,
			'tank_type' => $this->tank_type,
			'tcode' => $this->tcode,
			'inspection_location' => $this->inspection_location,
			'cleaning_location' => $this->cleaning_location,
			'customer' => $this->customer,
			'creator' => $this->creator,

			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ($isUserAdmin ? 1 : 0),
			'actions' => $actions
		];
	}
}
