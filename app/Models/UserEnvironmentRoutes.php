<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserEnvironmentRoutes extends Model{
    protected $table = "user_environment_routes";
    protected $fillable = ['email', 'created_by'];
    public $timestamps = true;

	//'pivot', 
	protected $hidden = ['created_at', 'updated_at' ];
}
