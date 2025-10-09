<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stuffing extends Model{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = "stuffing";
    protected $fillable = ['id', 'ref_no', 'company_id', 'customer_id', 'issue_date', 'dispatch_date', 'cfs_receipt_date', 'product_name', 'quantity_kg', 'packages_received', 'preshipment_invoice', 'excise_invoice', 'vehicle_nos', 'goods_condition_check', 'unloading_datetime', 'unloading_photos', 'goods_condition_cfs', 'cfs_area_clean', 'action_taken', 'goods_storage_location', 'pallets_condition', 'palletization_done', 'shipping_marks_done', 'shrink_wrapping_done', 'labeling_done', 'packaging_photos', 'packaging_done_time', 'container_seal_no', 'fumigation_done', 'stuffing_photos', 'stuffing_done', 'lashing_done', 'sealing_done', 'container_done_time', 'surveyor_id'];
    public $timestamps = true;
	
	public function rel_company_id(){
	return $this->belongsTo('App\Models\Company', 'company_id', 'id');
}

public function rel_customer_id(){
	return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
}

public function rel_surveyor_id(){
	return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
}


}