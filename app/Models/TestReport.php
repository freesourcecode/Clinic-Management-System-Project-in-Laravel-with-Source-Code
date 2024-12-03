<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
	protected $fillable = ['report_id', 'test_id', 'sample', 'status', 'report_type'];

	public function report()
	{
		return $this->belongsTo('App\Models\Report');
	}

	public function test()
	{
		return $this->belongsTo('App\Models\Test');
	}

	public function test_result()
	{
		return $this->hasOne('App\Models\TestResult');
	}

	public function test_reference_results()
	{
		return $this->hasMany('App\Models\TestReferenceResult');
	}

	public function test_antibiotic_results()
	{
		return $this->hasMany('App\Models\TestAntibioticResult');
	}

	public function examination_result()
	{
		return $this->hasOne('App\Models\ExaminationResult');
	}
    //
}
