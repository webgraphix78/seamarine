<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class JointSurvey extends Model
{
	protected $table = "joint_survey";
	protected $fillable = ['ref_no', 'address','company_id', 'date_of_issue', 'customer_name', 'company_name', 'instruction_1', 'instruction_2', 'instruction_3', 'instruction_4', 'instruction_5', 'tank_no', 'mfg_date', 'mgw', 'tare_weight', 'capacity', 'csc', 'comments', 'surveyor_id', 'created_by', 'status'];
	public $timestamps = true;

	public function company()
	{
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}

	public function surveyor()
	{
		return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
	}

	public function creator()
	{
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}
}
