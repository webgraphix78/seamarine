<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepotConditionSurvey extends Model{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = "depot_condition_survey";
    protected $fillable = ['id', 'tank_no', 'ref_no', 'company_id', 'inspection_date', 'mfg_sr_no', 'last_test_date', 'customer_id', 'mgw', 'tare_wt', 'iso_type', 'capacity', 'inspection_location_id', 'date_of_mfg', 'mfg', 'next_inspection_date', 'protection_cover', 'manhole_cover_fastening_bolts', 'top_safety_valve_sr_no', 'top_safety_valve', 'rupture_disc_series', 'dipping_pipe', 'air_valve', 'air_valve_label' ,'top_loading_label' , 'dipstick', 'manhole_gasket_type', 'manhole_gasket', 'walkway', 'top_loading', 'top_loading_flange', 'heating_plug_pipe', 'heating_pipe_covers', 'bottom_outlet_valve', 'bottom_valve_cap', 'bottom_valve_bolts_nuts', 'bottom_valve_lever', 'ladder', 'document_box', 'thermometer_temp', 'thermometer', 'remote_shut_off', 'hand_rail', 'rust', 'discolouration', 'surface_scoring', 'pitting_surface_pin', 'corrosion_mark', 'others', 'framework_front_end', 'cladding_front_end', 'framework_rare_end', 'cladding_rare_end', 'framework_right_side', 'cladding_right_side', 'framework_left_side', 'cladding_left_side', 'framework_top', 'cladding_top', 'framework_bottom', 'cladding_bottom', 'exterior_remarks', 'liquid_tank_no', 'liquid_inspection_date', 'liquid_inspection_location_id', 'liquid_img', 'remarks', 'surveyor_id'];
    public $timestamps = true;
	
	public function rel_company_id(){
	return $this->belongsTo('App\Models\Company', 'company_id', 'id');
}

	public function rel_customer_id(){
		return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
	}

	public function rel_inspection_location_id(){
		return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
	}

	public function rel_liquid_inspection_location_id(){
		return $this->belongsTo('App\Models\InspectionLocation', 'liquid_inspection_location_id', 'id');
	}

	public function rel_surveyor_id(){
		return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
	}


}
