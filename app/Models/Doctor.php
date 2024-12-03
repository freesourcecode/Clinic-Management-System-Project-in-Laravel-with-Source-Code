<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $fillable = 
    [
        'fee' , 'employee_id', 'opd_charge' ,
    ];

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
    public function opd_sales()
    {
        return $this->hasMany('App\Models\OpdSales');
    }
     public function reports()
    {
        return $this->hasMany('App\Models\Report');
    }

    public function doctor_referred()
    {
         return $this->hasMany('App\Models\DoctorReferred');
    }
    //
}
