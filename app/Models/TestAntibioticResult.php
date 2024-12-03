<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestAntibioticResult extends Model
{
    protected $fillable = ['test_report_id', 'test_antibiotic_id', 'result'];

    public function test_report()
    {
    	return $this->belongsTo('App\Models\TestReport');
    }

    public function test_antibiotic()
    {
    	return $this->belongsTo('App\Models\TestAntibiotic');
    }

}
