<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmTestingField extends Model{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = "sm_testing_field";
    protected $fillable = ['id', 'company_id', 'inspection_date', 'inspection_location_id', 'operator_lessor', 'tank_no', 'mfg', 'mfg_sr_no', 'csc', 'uk_dot', 'imdg', 'us_dot', 'rid', 'aar', 'bam', 'tc_impact', 'tir', 'uic', 'fra', 'tank_mfg_year', 'tank_max_g_wt', 'tank_tare_wt', 'tank_capacity', 'tank_desgin_temp', 'tank_mawp_bar', 'tank_test_press_bar', 'tank_top_discharge', 'tank_bottom_discharge', 'tank_no_of_closure', 'tank_shell_material', 'tank_shell_thickness', 'tank_heads_material', 'tank_head_thickness', 'tank_iso_type', 'insp_init_hydro_date', 'insp_hydro_witness', 'insp_last_hydro_date', 'insp_last_hydro_witness', 'insp_date', 'next_insp_date', 'insp_inter_perfom_na', 'insp_inter_perfom_in', 'insp_inter_perfom_remark', 'insp_ext_perfom_na', 'insp_ext_perfom_in', 'insp_ext_perfom_remark', 'insp_perfom_date_na', 'insp_perfom_date_in', 'insp_perfom_date_remark', 'insp_perfom_pressure_bar_na', 'insp_perfom_pressure_bar_in', 'insp_perfom_pressure_bar_remark', 'insp_perfom_fittin_na', 'insp_perfom_fittin_in', 'insp_perfom_fittin_remark', 'insp_perfom_frame_na', 'insp_perfom_frame_in', 'insp_perfom_frame_remark', 'insp_perfom_decals_na', 'insp_perfom_decals_in', 'insp_perfom_decals_remark', 'insp_perfom_steam_na', 'insp_perfom_steam_in', 'insp_perfom_steam_remark', 'p_mfgr_type_1', 'p_mfgr_type_2', 'p_sr_no_1', 'p_sr_no_2', 'p_full_flow_rate_1', 'p_full_flow_rate_2', 'p_operating_press_1', 'p_operating_press_2', 'p_vacuum_setting_1', 'p_vacuum_setting_2', 'p_bursting_disc_1', 'p_bursting_disc_2', 'platemark', 'comments', 'surveyor_id'];
    public $timestamps = true;
	
	public function rel_company_id(){
	return $this->belongsTo('App\Models\Company', 'company_id', 'id');
}

public function rel_inspection_location_id(){
	return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
}

public function rel_surveyor_id(){
	return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
}


}