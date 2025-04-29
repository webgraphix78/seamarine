<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Imo5Condition extends Model{
    protected $table = "imo5_condition";
    protected $fillable = ['container_no', 'tank_type_id', 'tcode_id', 'client', 'capacity', 'mfgt_date', 'gross_wt', 'csc', 'inspection_location_id', 'next_date', 'tare_wt', 'imo_status', 'sealed', 'cleaning_location_id', 'survey_date', 'customer_id', 'refno', 'scover', 'bvboxyn', 'bvboxsu', 'comments', 'markings_fitted_yes', 'markings_condition_good', 'marking_plates', 'data_fitted_yes', 'data_condition_good', 'data_plate', 'owners_plate_yes', 'owners_plate_good', 'owners_plate', 'manufactures_plate_yes', 'manufactures_plate_good', 'manufactures_plates', 'csc_plate_yes', 'csc_plate_good', 'csc_plate', 'customs_plate_yes', 'customs_plate_good', 'customs_plate', 'prefix_yes', 'prefix_good', 'prefix', 'imo_yes', 'imo_good', 'imo', 'country_code_yes', 'country_code_good', 'country_code', 'rear_ladder_yes', 'rear_ladder_good', 'rear_ladder', 'front_ladder_yes', 'front_ladder_good', 'front_ladder', 'document_box_yes', 'document_box_good', 'document_box', 'outlet_yes', 'outlet_good', 'outlet', 'bottom_outlet_yes', 'bottom_outlet_good', 'bottom_outlet', 'foot_valve_yes', 'foot_valve_good', 'foot_valve', 'remote_footvalve_yes', 'remote_footvalve_good', 'remote_footvalve', 'steam_tubes_yes', 'steam_tubes_good', 'steam_tubes', 'condensate_drains_yes', 'condensate_drains_good', 'condensate_drains', 'thermometer_yes', 'thermometer_good', 'thermometer', 'walkway_yes', 'walkway_good', 'walkway', 'manlid_protection_yes', 'manlid_protection_good', 'manlid_protection', 'spillbox_yes', 'spillbox_good', 'spillbox', 'manlid_yes', 'manlid_good', 'manlid', 'manlid_bolts_yes', 'manlid_bolts_good', 'manlid_bolts', 'dipstick_yes', 'dipstick_good', 'dipstick', 'safety_cover_yes', 'safety_cover_good', 'safety_cover', 'calibration_chart_yes', 'calibration_chart_good', 'calibration_chart', 'relief_valves_yes', 'relief_valves_good', 'relief_valves', 'pressure_gauges_yes', 'pressure_gauges_good', 'pressure_gauges', 'flame_traps_yes', 'flame_traps_good', 'flame_traps', 'air_line_cap_yes', 'air_line_cap_good', 'air_line_cap', 'air_line_valve_yes', 'air_line_valve_good', 'air_line_valve', 'top_disch_prot_yes', 'top_disch_prot_good', 'top_disch_prot', 'top_disch_valve_yes', 'top_disch_valve_good', 'top_disch_valve', 'top_condition_yes', 'top_condition_good', 'top_condition', 'created_by', 'status'];
    public $timestamps = true;
	
	public function tank_type(){
	return $this->belongsTo('App\Models\TankType', 'tank_type_id', 'id');
}

public function tcode(){
	return $this->belongsTo('App\Models\Tcode', 'tcode_id', 'id');
}

public function inspection_location(){
	return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
}

public function cleaning_location(){
	return $this->belongsTo('App\Models\CleaningLocation', 'cleaning_location_id', 'id');
}

public function customer(){
	return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
}

public function creator(){
	return $this->belongsTo('App\Models\User', 'created_by', 'id');
}


}
