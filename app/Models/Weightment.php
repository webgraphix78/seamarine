<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Weightment extends Model
{
	protected $table = "weightment";
	protected $fillable = ['ref_no', 'company_id', 'customer_id', 'subject', 'field_1_key', 'field_1_value_1', 'field_1_value_2', 'field_2_key', 'field_2_value_1', 'field_2_value_2', 'field_3_key', 'field_3_value_1', 'field_3_value_2', 'field_4_key', 'field_4_value_1', 'field_4_value_2', 'field_5_key', 'field_5_value_1', 'field_5_value_2', 'comments', 'surveyor_id', 'date_of_issue', 'created_by', 'status'];
	public $timestamps = true;
	
	public function company()
	{
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}
	
	public function customer()
	{
		return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
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
