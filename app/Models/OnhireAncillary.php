<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class OnhireAncillary extends Model{
    protected $table = "onhire_ancillary";
    protected $fillable = ['onhire_id', 'ancf_1', 'ancf_1_cladding', 'ancf_2', 'ancf_2_ladder', 'ancf_2_ladder_type', 'ancf_3', 'ancf_3_placard', 'ancf_4', 'ancf_4_decals', 'ancf_5', 'ancf_5_tgauge', 'ancf_5_other', 'ancf_5_temperature', 'ancf_5_ttype', 'ancf_6', 'ancf_6_doc_tube', 'ancf_7', 'ancf_7_steam_tube', 'ancf_7_steam_tube_value_1', 'ancf_7_steam_tube_value_2', 'ancf_8', 'ancf_8_steam_acc', 'ancf_8_steam_acc_value', 'ancf_9', 'ancf_9_bottom_comp', 'ancf_10', 'ancf_10_electrical', 'ancf_10_manufacturer'];
    public $timestamps = false;
	
	
}
