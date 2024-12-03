<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'object',
        'action',
        'name',
    ];

	/**
     * relation to roles table.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public static function grouped()
    {
        $permissions = self::all();

        $grouped_permission = [];

        foreach ($permissions as $key => $permission) {
            $grouped_permission[$permission->object][] = $permission;
        }
        return $grouped_permission;
    }
}

