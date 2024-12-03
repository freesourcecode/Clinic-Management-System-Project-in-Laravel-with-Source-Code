<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
	protected $fillable = ['name', 'description', 'price'];

	public function packageSales()
	{
		return $this->hasMany('App\Models\PackageSale');
	}
	public function packageTests()
	{
		return $this->hasMany('App\Models\PackageTest');
	}
    //
}
