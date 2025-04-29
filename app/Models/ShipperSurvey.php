<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ShipperSurvey extends Model
{
	protected $table = "shipper_survey";
	protected $fillable = ['ref_no', 'survey_date', 'dt_inspection_date', 'company_id', 'last_cargo_carried', 'cha', 'tank_container_no', 'surveyor_id', 'for_shipper_id', 'customer_id', 'csc_no', 'type', 'inspection_location_id', 'mfg_date', 'last_inspection_date', 'capacity', 'next_date', 'gross_wt', 'tare_wt', 'frame_tank', 'manlid_valve', 'serial_nos', 'steam_jacket', 'bullet_seal', 'gasket_type', 'manlid_cover', 'distick', 'calibration', 'siphon_tube', 'pressure_gauge', 'temperature_gauge', 'prv_poppet', 'top_provision', 'interior_clean', 'valves_free', 'non_transferable', 'polish_buffing', 'note', 'manlid_seal_no', 'airline_seal_no', 'bottom_seal_no', 'top_seal', 'created_by', 'status'];
	public $timestamps = true;

	public function company()
	{
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}

	public function surveyor()
	{
		return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
	}

	public function for_shipper()
	{
		return $this->belongsTo('App\Models\Customer', 'for_shipper_id', 'id');
	}

	public function customer()
	{
		return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
	}

	public function inspection_location()
	{
		return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
	}

	public function creator()
	{
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}
}
