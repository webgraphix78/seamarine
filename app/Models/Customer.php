<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = "customer";
	protected $fillable = ['name', 'contact_person', 'fax_number', 'address', 'email', 'mobile_number', 'is_cha', 'created_by', 'status'];
	public $timestamps = true;

	public function creator()
	{
		return $this->belongsTo('App\Models\User', 'created_by', 'id');
	}
}
