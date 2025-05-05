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

	protected $fillable = ['id', 'ref_no', 'company_id', 'request_of_name', 'attend', 'of_name', 'attend_day', 'attend_month', 'unit_no', 'csc_approval_no', 'mfg', 'mfg_date', 'mfg_serial_no', 'container_type', 'iso_type', 'next_csc_inspection_date', 'csc_reinspection_date', 'survey_without_prejudice', 'created_by', 'status'];
	
	public $timestamps = true;

	public function rel_company_id(){
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}

	public function creator(){
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}
}
