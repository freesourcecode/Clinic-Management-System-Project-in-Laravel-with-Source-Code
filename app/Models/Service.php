<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
    
	protected $fillable = ['name', 'amount', 'department_id'];

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function tests()
    {
    	return $this->hasMany('App\Models\Test');
    }

    public function service_sales()
    {
        return $this->hasMany('App\Models\ServiceSale');
    }

    
    //
}
