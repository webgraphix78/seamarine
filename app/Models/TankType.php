<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class TankType extends Model{
    protected $table = "tank_type";
    protected $fillable = ['type', 'created_by', 'status'];
    public $timestamps = true;
	
	public function creator(){
	return $this->belongsTo('App\Models\User', 'created_by', 'id');
}


}
