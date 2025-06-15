<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GasFreeReport extends Model{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = "gas_free_report";
    protected $fillable = ['id', 'tank_no', 'company_id', 'type', 'ref_no', 'csc_no', 'mfg', 'ned', 'mgw', 'tare_wt', 'capacity', 'inspection_date', 'inspection_location_id', 'customer_id', 'last_cargo_carried', 'lel_inst', 'lel_sr_no', 'calibration_validity_dt', 'calibration_sr_no', 'oxygen_mtr', 'oxy_calibration_validity', 'in_air_lel', 'in_air_oxygen', 'in_space_lel', 'in_space_oxygen', 'reacted_to_hydrocarbon', 'alarmed_at', 'tank_is_gas_free', 'surveyor_id'];
    public $timestamps = true;
	
	public function rel_company_id(){
	return $this->belongsTo('App\Models\Company', 'company_id', 'id');
}

public function rel_inspection_location_id(){
	return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
}

public function rel_customer_id(){
	return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
}

public function rel_surveyor_id(){
	return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
}


}