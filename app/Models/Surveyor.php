<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Surveyor extends Model{
    protected $table = "surveyor";
    protected $fillable = ['name', 'address', 'email', 'mobile_number', 'created_by', 'status'];
    public $timestamps = true;
	
	public function creator(){
	return $this->belongsTo('App\Models\User', 'created_by', 'id');
}


}
