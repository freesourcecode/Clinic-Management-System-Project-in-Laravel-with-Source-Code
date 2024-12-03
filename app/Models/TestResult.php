<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
	protected $fillable = ['test_report_id', 'result', 'status'];
	

	public function test_report()
	{
		return $this->belongsTo('App\Models\TestReport');
	}
	
    //
}
