<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Company extends Model{
    protected $table = "company";
    protected $fillable = ['name', 'signature_url', 'created_by', 'status'];
    public $timestamps = true;
	
	public function creator(){
	return $this->belongsTo('App\Models\User', 'created_by', 'id');
}


}
