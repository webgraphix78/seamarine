<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformObject extends Model{
    protected $table = "platform_object";
    protected $fillable = ['title', 'name', 'url', 'phicons', 'role_id', 'permissions', 'status', 'created_by'];
    public $timestamps = true;
	
	protected $casts = [
        'status' => 'boolean',
  		'permissions' => 'array',
	];
}
