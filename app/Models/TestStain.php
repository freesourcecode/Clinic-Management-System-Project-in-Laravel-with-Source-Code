<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestStain extends Model
{
    protected $fillable = ['test_id', 'test_names'];

    public function test()
    {
    	return $this->belongsTo('App\Models\Test');
    }

    public function test_name()
    {
    	return unserialize($this->test_names);
    }


}
