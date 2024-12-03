<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission')->withTimestamps();
    }

    public static function dropdown()
    {
        return [null => '--Choose Role--'] + Self::all()->pluck('name', 'id')->toArray();
    }
}

