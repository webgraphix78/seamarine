<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class OnhireUnitnr extends Model{
    protected $table = "onhire_unitnr";
    protected $fillable = ['onhire_id', 'unit_nr_1', 'unit_nr_1_calibration', 'unit_nr_1_calibration_value', 'unit_nr_2', 'unit_nr_2_manlid_swing', 'unit_nr_2_manlid_swing_value', 'unit_nr_2_manlid_swing_other', 'unit_nr_3', 'unit_nr_3_collapsible', 'unit_nr_4', 'unit_nr_4_dipstick', 'unit_nr_4_dipstick_value', 'unit_nr_5', 'unit_nr_5_topcover', 'unit_nr_6', 'unit_nr_6_walkway', 'unit_nr_7', 'unit_nr_7_manlid_gasket', 'unit_nr_7_manlid_gasket_other', 'unit_nr_8', 'unit_nr_8_grounding', 'unit_nr_9', 'unit_nr_9_bottomplate', 'unit_nr_10', 'unit_nr_10_pti_date', 'created_by', 'onhire_id'];
    public $timestamps = false;
	
	
}
