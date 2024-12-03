<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpdSales extends Model
{
	protected $fillable = ['doctor_id', 'opd_name','invoice_id', 'doctor_fee', 'opd_charge' ,'status'] ;
    
    public function doctor()
    {
    	return $this->belongsTo('App\Models\Doctor');

    }

    public function invoice()
    {
    	return $this->belongsTo('App\Models\Invoice');
    	
    }
}
