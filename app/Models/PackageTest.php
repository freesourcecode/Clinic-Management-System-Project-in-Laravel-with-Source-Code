<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageTest extends Model
{
	protected $fillable = ['package_id', 'test_id', 'status'];

	public function package()
	{
		return $this->belongsTo('App\Models\Package');
	}
    //
    public function test()
	{
		return $this->belongsTo('App\Models\Test');
	}
    //
}
