<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestReferenceResult extends Model
{
    protected $fillable = ['test_report_id', 'test_reference_id', 'result', 'flag'];

    public function test_report()
    {
    	return $this->belongsTo('App\Models\TestReport');
    }
    public function test_reference()
    {
    	return $this->belongsTo('App\Models\TestReference');
    }
}
