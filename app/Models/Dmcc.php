<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dmcc extends Model{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = "dmcc";
    protected $fillable = ['id', 'tank_no', 'company_id', 'inspection_date', 'loading_of', 'seals_intact_time', 'seals_intact_remark', 'seals_broken', 'pretrip_inspection_qc', 'bottom_valve_checked', 'n2_released_dn40', 'emergency_remote_checked', 'manlid_checked', 'manlid_valve_closed', 'tank_cleared_for_purging', 'dn80_connector_fitted', 'n2_purged_1', 'n2_released_1', 'n2_purged_2', 'n2_released_2', 'n2_purged_3', 'n2_released_3', 'qc_permission_granted', 'bscl_pumping_started', 'dn40_opened_during_loading', 'loading_completed_dn40_closed', 'butterfly_valve_closed', 'cargo_sample_removed', 'butterfly_valve_reclosed', 'n2_purged_final', 'final_inspection_done', 
    'emergency_remote_checked_remark','n2_released_dn40_remark', 'bottom_valve_checked_remark' ,'pretrip_inspection_qc_remark' ,'seals_broken_remark','manlid_checked_remark','manlid_valve_closed_remark','tank_cleared_for_purging_remark','dn80_connector_fitted_remark','n2_purged_1_remark','n2_released_1_remark','n2_purged_2_remark','n2_released_2_remark','n2_purged_3_remark','n2_released_3_remark','qc_permission_granted_remark','bscl_pumping_started_remark','dn40_opened_during_loading_remark','loading_completed_dn40_closed_remark','butterfly_valve_closed_remark','cargo_sample_removed_remark','butterfly_valve_reclosed_remark','n2_purged_final_remark','final_inspection_done_remark', 'n2_cylinder_nos', 'total_no_cylinder', 'bscl_rep', 'surveyor_id'];
    public $timestamps = true;
	
	public function rel_company_id(){
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }

    public function rel_surveyor_id(){
        return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
    }


}
