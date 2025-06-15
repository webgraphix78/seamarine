<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cscre extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	protected $table = "cscre";

	protected $fillable = ['id', 'ref_no', 'company_id', 'customer_name', 'serial_no', 'company_name', 'inspection_date', 'inspection_location', 'address', 'container_no', 'iso_type', 'csc_approval_no', 'mfg', 'mfg_date', 'mfg_type', 'customs_no', 'csc_reinspection_date', 'comments',  'max_gross_weight', 'tare_weight', 'stacking_weight', 'racking_test_force', 'surveyor_name', 'issue_date', 'created_by', 'status'];
	
	public $timestamps = true;

	public function rel_company_id(){
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}

	public function creator(){
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}
}
