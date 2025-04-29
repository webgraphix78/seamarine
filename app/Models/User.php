<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [ 'name', 'email', 'password', 'department_id', 'date_of_joining', 'employee_code', 'hierarchy_node_id', 'role_id',  'customer_id', 'status', 'created_by' ];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [ 'password', 'remember_token' ];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function role(){
		return $this->belongsTo('App\Models\Role', 'role_id', 'id');
	}

	public function department(){
		return $this->belongsTo('App\Models\Department', 'department_id', 'id');
	}
	
	public function customer(){
		return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
	}
}
