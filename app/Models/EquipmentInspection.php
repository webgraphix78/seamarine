<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentInspection extends Model{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = "equipment_inspection";
    protected $fillable = ['id', 'ref_no', 'company_id', 'inspection_date', 'tank_no', 'last_cargo_carried', 'empty_clean', 'empty_dirty', 'loaded', 'surveyor_id', 'hazard_class', 'eq_inspection_status', 'last_test_date', 'capacity', 'equipment_type', 'csc', 'loaded_at', 'tank_type', 'mfg_date', 'cfs', 'for_id', 'next_date', 'country', 'inspection_location_id', 'customer_id', 'cha_client', 'tare_weight', 'mgw', 'bottom_discharge_tir', 'bottom_discharge_seal', 'bottom_discharge_comments', 'manlid_tir', 'manlid_seal', 'manlid_comments', 'airline_value_tir', 'airline_value_seal', 'airline_value_comments', 'prv_tir', 'prv_seal', 'prv_comments', 'top_discharge_tir', 'top_discharge_seal', 'top_discharge_comments', 'to_discharge_fill_flange_tir', 'to_discharge_fill_flange_seal', 'to_discharge_fill_flange_comments', 'safety_provision_tir', 'safety_provision_seal', 'safety_provision_comments', 'vapour_return_provision_tir', 'vapour_return_provision_seal', 'vapour_return_provision_comments', 'fwd_inspection_hatch_tir', 'fwd_inspection_hatch_seal', 'fwd_inspection_hatch_comments', 'afg_inspection_hatch_tir', 'afg_inspection_hatch_seal', 'afg_inspection_hatch_comments', 'comments', 'created_by', 'status'];
    public $timestamps = true;
	
	public function rel_company_id(){
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}

	public function rel_surveyor_id(){
		return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
	}

	public function rel_for_id(){
		return $this->belongsTo('App\Models\Customer', 'for_id', 'id');
	}

	public function rel_inspection_location_id(){
		return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
	}

	public function rel_customer_id(){
		return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
	}

	public function creator(){
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}

}