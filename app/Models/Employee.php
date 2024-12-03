<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    

	protected $fillable = 
	[
        'first_name', 'middle_name', 'last_name','email', 'education', 'phone', 'description', 'certificate', 'speciality', 'address', 'working_day' , 'in_time' , 'out_time' ,
        'type' , 'department_id'
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
    public function doctor()
    {
        return $this->hasMany('App\Models\Doctor');
    }
   
    //
}
