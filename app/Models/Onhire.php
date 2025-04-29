<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Onhire extends Model
{
	protected $table = "onhire";
	protected $fillable = ['company_id', 'ref_no', 'customer_id', 'survey_type', 'inspection_date', 'inspection_location_id', 'form_liquid_tanks', 'surveyor_id', 'unit_nr', 'tank_type_id', 'tcode_id', 'manufacturer', 'iso_type', 'adr', 'serial_no', 'first_test', 'first_by', 'last_25', 'last_25_by', 'last_5', 'last_5_by', 'next_due_date', 'csc_acep_date', 'max_gross_wgt', 'tare_wgt', 'capacity', 'mawp', 'test_pressure', 'steam_tube_wp', 'steam_test_pressure', 'shell_tank_material', 'shell_head', 'shell_thickness', 'shell_head_thickness', 'onhire_main_id', 'onhire_ancillary_id', 'comment_1', 'comment_2', 'created_by', 'status'];
	public $timestamps = true;

	public function company()
	{
		return $this->belongsTo('App\Models\Company', 'company_id', 'id');
	}

	public function customer()
	{
		return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
	}

	public function inspection_location()
	{
		return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
	}

	public function surveyor()
	{
		return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
	}

	public function tank_type()
	{
		return $this->belongsTo('App\Models\TankType', 'tank_type_id', 'id');
	}

	public function tcode()
	{
		return $this->belongsTo('App\Models\Tcode', 'tcode_id', 'id');
	}

	public function creator()
	{
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}

	// Important relationships

	public function main()
	{
		return $this->belongsTo('App\Models\OnhireMain', 'onhire_main_id', 'id');
	}

	public function ancillary()
	{
		return $this->belongsTo('App\Models\OnhireAncillary', 'onhire_ancillary_id', 'id');
	}

	public function unitnr()
	{
		return $this->belongsTo('App\Models\OnhireUnitnr', 'onhire_unitnr_id', 'id');
	}
}
