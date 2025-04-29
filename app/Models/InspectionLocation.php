<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class InspectionLocation extends Model
{
	protected $table = "inspection_location";
	protected $fillable = ['name', 'country_id', 'created_by', 'status'];
	public $timestamps = true;

	public function country()
	{
		return $this->belongsTo('App\Models\Country', 'country_id', 'id');
	}

	public function creator()
	{
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}
}
