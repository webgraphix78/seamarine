<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model{
    protected $table = "media_gallery";
    protected $fillable = ['object_name', 'object_id', 'name', 'url', 'extension', 'size', 'sequence_no', 'created_by'];
    public $timestamps = true;

	protected $hidden = ['created_at', 'updated_at' ];
	
}
