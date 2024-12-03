<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
	protected $fillable = 
	[
        'name', 'description', 'time', 'patient_id', 'doctor_id', 'status', 'appointment_date'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
    
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
    //
}
