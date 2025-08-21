<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prv extends Model{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = "prv";
    protected $fillable = ['id', 'ref', 'date_of_issue', 'company_id', 'customer_id', 'inspection_location_id', 'address', 'tank_no', 'inspection_date', 'address_2', 'mfg', 'serial_no', 'full_flow_rate', 'op', 'vaccum_set', 'bursting_disc', 'surveyor_id'];
    public $timestamps = true;
    
    public function rel_company_id(){
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }
	
	public function rel_customer_id(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    public function rel_inspection_location_id(){
        return $this->belongsTo('App\Models\InspectionLocation', 'inspection_location_id', 'id');
    }

    public function rel_surveyor_id(){
        return $this->belongsTo('App\Models\Surveyor', 'surveyor_id', 'id');
    }


}