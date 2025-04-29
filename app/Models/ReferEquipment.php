<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferEquipment extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	protected $table = "refer_equipment";
	protected $fillable = ['id', 'ref_no', 'company_id', 'inspection_date', 'inspection_location_id', 'customer_id', 'tank_no', 'shipping_agency', 'container_type', 'booking_no', 'model', 'serial', 'in_service', 'date_of_last_pretrip', 'run_through', 'temperature_set_pti', 'temperature_set_rechecked', 'exterior', 'exterior_right', 'exterior_left', 'exterior_front', 'exterior_roof', 'exterior_under', 'exterior_rear', 'exterior_rear_door_right', 'exterior_rear_door_left', 'seaworthiness', 'interior', 'interior_right', 'interior_left', 'interior_front', 'interior_ceiling', 'interior_floor', 'interior_rear', 'interior_rear_door_right', 'interior_rear_door_left', 'clean_free_from_odour', 'cable_440', 'controller', 'transformer', 'mcb', 'compressor', 'unit_bolts_fasteners', 'power_plug_440', 'contactors', 'battery', 'display_board', 'wiring_terminals', 'refg_run_through', 'comments', 'surveyor_id', 'created_by', 'status'];
	public $timestamps = true;

	public function rel_company_id()
	{
		return $this->belongsTo('App\Models\user', 'company_id', 'id');
	}

	public function rel_inspection_location_id()
	{
		return $this->belongsTo('App\Models\user', 'inspection_location_id', 'id');
	}

	public function rel_customer_id()
	{
		return $this->belongsTo('App\Models\user', 'customer_id', 'id');
	}

	public function rel_surveyor_id()
	{
		return $this->belongsTo('App\Models\user', 'surveyor_id', 'id');
	}

	public function creator()
	{
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}
}
