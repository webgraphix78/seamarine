<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Drybox extends Model
{
	protected $table = "drybox";
	// , 'image_1_url', 'image_2_url', 'image_3_url', 'image_4_url', 'image_5_url', 'image_6_url', 'image_7_url', 'image_8_url', 'image_9_url', 'image_10_url'
	protected $fillable = ['ref', 'company_id', 'inspection_location_id', 'inspection_date', 'dt_inspection_date', 'container_no', 'size', 'tare_wt', 'gross_wt', 'csc_no', 'mfgt_date', 'customer_id', 'surveyor_id', 'rear_end', 'right_side', 'front_end', 'left_side', 'top_roof', 'under_structure', 'interior', 'drybox_status', 'note', 'created_by', 'status'];
	public $timestamps = true;

	public function company()
	{
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}

	public function inspectionlocation()
	{
		return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
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
