<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Imo1 extends Model
{
	protected $table = "imo1";
	protected $fillable = ['ref_no', 'company_id', 'inspection_date', 'dt_inspection_date', 'csc', 'loaded_at', 'tank_type_id', 'tank_no', 'tcode_id', 'last_cargo_carried', 'mfgt_date', 'empty_clean', 'empty_dirty', 'cfs', 'for_client', 'loaded', 'next_date', 'surveyor_id', 'country', 'hazard_class', 'inspection_location_id', 'customer_id', 'cha_client', 'imo1_status', 'walkway_image', 'last_inspection_date', 'front_panel_cladding', 'front_panel_decals', 'rear_panel_cladding', 'rear_panel_decals', 'right_side_cladding', 'right_side_decals', 'left_side_cladding', 'left_side_decals', 'top_cladding', 'top_decals', 'underside_cladding', 'underside_decals', 'front_end_damage', 'rear_end_damage', 'right_side_damage', 'left_side_damage', 'top_damage', 'underside_damage', 'exterior_wash_needed', 'rusty_frame', 'patchy_cladding', 'product_spills', 'renew_logo', 'previous_haz', 'ladder_nos', 'ladder_cond_status_id', 'document_box_nos', 'document_box_cond_status_id', 'temperature_gauge_nos', 'temperature_gauge_cond_status_id', 'steam_nos', 'steam_cond_status_id', 'steam_pressure_nos', 'steam_pressure_cond_status_id', 'remote_system_nos', 'remote_system_cond_status_id', 'electrical_heating_nos', 'electrical_heating_cond_status_id', 'manlid_nos', 'manlid_cond_status_id', 'manlid_swing_nos', 'manlid_swing_cond_status_id', 'insp_hatch_nos', 'insp_hatch_cond_status_id', 'insp_hatch_swing_bolt_no', 'insp_hatch_swing_bolt_cond_status_id', 'spill_box_nos', 'spill_box_cond_status_id', 'pre_valve_nos', 'pre_valve_cond_status_id', 'pre_bursting_disc_nos', 'pre_bursting_disc_cond_status_id', 'walkyway_ls_nos', 'walkyway_ls_cond_status_id', 'walkyway_scs_nos', 'walkyway_scs_cond_status_id', 'walkyway_mls_nos', 'walkyway_mls_cond_status_id', 'airline_valve_nos', 'airline_valve_cond_status_id', 'tank_gauge_nos', 'tank_gauge_cond_status_id', 'dipstick_nos', 'dipstick_cond_status_id', 'calibration_chart_nos', 'calibration_chart_cond_status_id', 'syphon_pipe_nos', 'syphon_pipe_cond_status_id', 'b_fly_valve_nos', 'b_fly_valve_cond_status_id', 'blank_flange_nos', 'blank_flange_cond_status_id', 'top_vapour_nos', 'top_vapour_cond_status_id', 'top_vapour_bolts_nos', 'top_vapour_bolts_cond_status_id', 'flanged_provision_nos', 'flanged_provision_cond_status_id', 'bottom_foot_nos', 'bottom_foot_cond_status_id', 'bottom_bfly_nos', 'bottom_bfly_cond_status_id', 'bottom_outlet_flange_nos', 'bottom_outlet_flange_cond_status_id', 'bottom_valve_handle_nos', 'bottom_valve_handle_cond_status_id', 'bottom_bfly_ball_nos', 'bottom_bfly_ball_cond_status_id', 'fusible_link_no', 'fusible_link_cond_status_id', 'camera', 'gps', 'last_test_date', 'tare_wt', 'capacity', 'mgw', 'comments', 'created_by', 'status'];
	public $timestamps = true;

	public function company()
	{
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}
	
	public function tanktype()
	{
		return $this->belongsTo('App\Models\TankType', 'tank_type_id', 'id');
	}

	public function tcode()
	{
		return $this->belongsTo('App\Models\Tcode', 'tcode_id', 'id');
	}

	public function for_client_rec()
	{
		return $this->belongsTo('App\Models\Customer', 'for_client', 'id');
	}

	public function surveyor()
	{
		return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
	}

	public function inspection_location()
	{
		return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
	}

	public function customer()
	{
		return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
	}

	public function ladder_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'ladder_cond_status_id', 'id');
	}

	public function document_box_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'document_box_cond_status_id', 'id');
	}

	public function temperature_gauge_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'temperature_gauge_cond_status_id', 'id');
	}

	public function steam_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'steam_cond_status_id', 'id');
	}

	public function steam_pressure_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'steam_pressure_cond_status_id', 'id');
	}

	public function remote_system_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'remote_system_cond_status_id', 'id');
	}

	public function electrical_heating_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'electrical_heating_cond_status_id', 'id');
	}

	public function manlid_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'manlid_cond_status_id', 'id');
	}

	public function manlid_swing_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'manlid_swing_cond_status_id', 'id');
	}

	public function insp_hatch_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'insp_hatch_cond_status_id', 'id');
	}

	public function insp_hatch_swing_bolt_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'insp_hatch_swing_bolt_cond_status_id', 'id');
	}

	public function spill_box_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'spill_box_cond_status_id', 'id');
	}

	public function pre_valve_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'pre_valve_cond_status_id', 'id');
	}

	public function pre_bursting_disc_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'pre_bursting_disc_cond_status_id', 'id');
	}

	public function walkyway_ls_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'walkyway_ls_cond_status_id', 'id');
	}

	public function walkyway_scs_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'walkyway_scs_cond_status_id', 'id');
	}

	public function walkyway_mls_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'walkyway_mls_cond_status_id', 'id');
	}

	public function airline_valve_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'airline_valve_cond_status_id', 'id');
	}

	public function tank_gauge_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'tank_gauge_cond_status_id', 'id');
	}

	public function dipstick_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'dipstick_cond_status_id', 'id');
	}

	public function calibration_chart_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'calibration_chart_cond_status_id', 'id');
	}

	public function syphon_pipe_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'syphon_pipe_cond_status_id', 'id');
	}

	public function bfly_valve_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'b_fly_valve_cond_status_id', 'id');
	}

	public function blank_flange_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'blank_flange_cond_status_id', 'id');
	}

	public function top_vapour_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'top_vapour_cond_status_id', 'id');
	}

	public function top_vapour_bolts_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'top_vapour_bolts_cond_status_id', 'id');
	}

	public function flanged_provision_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'flanged_provision_cond_status_id', 'id');
	}

	public function bottom_foot_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'bottom_foot_cond_status_id', 'id');
	}

	public function bottom_bfly_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'bottom_bfly_cond_status_id', 'id');
	}

	public function bottom_outlet_flange_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'bottom_outlet_flange_cond_status_id', 'id');
	}

	public function bottom_valve_handle_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'bottom_valve_handle_cond_status_id', 'id');
	}

	public function bottom_bfly_ball_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'bottom_bfly_ball_cond_status_id', 'id');
	}

	public function fusible_link_cond_status()
	{
		return $this->belongsTo('App\Models\ImoConditionStatus', 'fusible_link_cond_status_id', 'id');
	}

	public function creator()
	{
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}
}
