<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    

	protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }
    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }
    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }
    
     public function labs()
    {
        return $this->hasMany('App\Models\Lab');
    }
    //
}
