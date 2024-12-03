<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorReferred extends Model
{
    protected $fillable = ['doctor_id', 'invoice_id'];

    public function doctor()
    {
    	return $this->belongsTo('App\Models\Doctor');
    }

     public function invoice()
    {
    	return $this->belongsTo('App\Models\Invoice');
    }
}
