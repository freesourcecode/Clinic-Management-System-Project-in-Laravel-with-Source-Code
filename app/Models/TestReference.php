<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestReference extends Model
{
    protected $fillable = ['name', 'unit', 'range', 'parent_id'];

    /**
     * Get the parent that owns the category.
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\TestReference', 'parent_id');
    }
     /**
     * Get the children category that related the category.
     */
    public function children()
    {
        return $this->hasMany('App\Models\TestReference', 'parent_id');
    }

    public function test()
    {
    	return $this->belongsToMany('App\Models\Test');
    }

    public function test_reference_results()
    {
        return $this->hasMany('App\Models\TestReferenceResult');
    }
}
