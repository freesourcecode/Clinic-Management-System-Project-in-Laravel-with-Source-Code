<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    
	protected $fillable = 
	[
        'first_name', 'middle_name', 'last_name','email', 'age', 'phone', 'gender', 'birth_date', 'country', 'state', 'district' , 'location' , 'occupation' ,
        'description' , 'relative_name' , 'relative_phone' , 'marital_status', 'blood_group',
    ];

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }
    
    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }
     public function reports()
    {
        return $this->hasMany('App\Models\Report');
    }
    
    public function packageSales()
    {
        return $this->hasMany('App\Models\PackageSale');
    }
    //
}
