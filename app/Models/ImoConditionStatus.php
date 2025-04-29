<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ImoConditionStatus extends Model{
    protected $table = "imo_condition_status";
    protected $fillable = ['title', 'code', 'created_by', 'status'];
    public $timestamps = true;
	
	public function creator(){
	return $this->belongsTo('App\Models\User', 'created_by', 'id');
}


}
