<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationResult extends Model
{
     protected $fillable = ['test_report_id', 'macroscopic_result', 'microscopic_result','result'];

     public function test_report ()
     {
     	return $this->belongsTo('App\Models\TestReport');
     }
}
