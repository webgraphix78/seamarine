<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class OnhireMain extends Model{
    protected $table = "onhire_main";
    protected $fillable = ['onhire_id', 'bd_x', 'bd_x_value', 'bd_other', 'bd_butterfly_ball', 'bd_butterfly_ball_sn', 'bd_tir_strip', 'bd_spacers', 'fv_x', 'fv_x_value', 'fv_other', 'fv_option', 'fv_tir_strip', 'bocp_x', 'bocp_x_value', 'bocp_3_bsp', 'bocp_cap', 'rt_x', 'rt_type', 'rt_fusible_link', 'td_x', 'td_dn', 'td_dn_value_1', 'td_dn_value_2', 'td_dn_other', 'td_butterfly_ball', 'td_tir_strip', 'td_siphon_tube', 'tl_x', 'tl_dn', 'tl_dn_value_1', 'tl_dn_value_2', 'tl_dn_other', 'tl_butterfly_ball', 'tl_tir_strip', 'av_x', 'av_value_inch', 'av_value', 'av_other', 'av_butterfly_ball', 'avc_type', 'avc_tir_strip', 'avc_cap_blank_v1', 'avc_cap_blank_v2', 'avc_cap_blank_v3', 'avc_air_pressure_gauge', 'srv1_x', 'srv1_value1', 'srv1_other', 'srv1_value2', 'srv1_value3', 'srv1_pressure', 'srv1_vac', 'srv1_serial', 'srv1_tir_strip', 'srv1_flame_screen', 'srv2_x', 'srv2_value1', 'srv2_other', 'srv2_value2', 'srv2_value3', 'srv2_pressure', 'srv2_vac', 'srv2_serial', 'srv2_tir_strip', 'srv2_flame_screen', 'rd1_x', 'rd1_manufacturer', 'rd1_bar', 'rd1_size', 'rd2_x', 'rd2_manufacturer', 'rd2_bar', 'rd2_size', 'srv1_mano_x', 'srv1_mano_value1', 'srv1_mano_bar', 'srv2_mano_x', 'srv2_mano_value', 'srv2_mano_bar', 'gps', 'camera'];
    public $timestamps = false;
	
	
}
