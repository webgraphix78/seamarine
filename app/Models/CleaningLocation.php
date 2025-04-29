<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CleaningLocation extends Model
{
	protected $table = "cleaning_location";
	protected $fillable = ['name', 'created_by', 'status'];
	public $timestamps = true;

	public function creator()
	{
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}
}
