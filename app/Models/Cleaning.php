<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Cleaning extends Model
{
	protected $table = "cleaning";
	protected $fillable = ['company_id', 'ref_no', 'tank_type_id', 'tank_no', 'tcode_id', 'customer_id', 'csc', 'mfgt_date', 'last_inspection_date', 'mgw', 'next_date', 'capacity', 'tare_wt', 'inspection_locn', 'inspection_date', 'dt_inspection_date', 'client_id', 'cleaning_location_id', 'last_cargo_carried', 'surveyor_id', 'frame_tank', 'manlid_valves', 'serial_nos', 'labels_removed', 'entry', 'odour_free', 'clean_free', 'corrosion_free', 'dry', 'valves', 'manlid_seal', 'gas_free', 'siphon', 'remarks', 'interior', 'exterior', 'sealno', 'created_by', 'status'];
	public $timestamps = true;

	public function company()
	{
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}

	public function tank()
	{
		return $this->belongsTo('App\Models\TankType', 'tank_type_id', 'id');
	}

	public function tcode()
	{
		return $this->belongsTo('App\Models\Tcode', 'tcode_id', 'id');
	}

	public function customer(){
		return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
	}

	// public function client()
	// {
	// 	return $this->belongsTo('App\Models\Customer', 'client_id', 'id');
	// }

	public function inspectionlocation()
	{
		return $this->belongsTo('App\Models\InspectionLocation', 'inspection_locn', 'id');
	}

	public function cleaninglocation()
	{
		return $this->belongsTo('App\Models\CleaningLocation', 'cleaning_location_id', 'id');
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
