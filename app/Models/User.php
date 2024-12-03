<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

  

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role_id','password'
    ];

    /**
    * Query for return active attributes
    * @param query
    * @return Query
    */
          
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

}
