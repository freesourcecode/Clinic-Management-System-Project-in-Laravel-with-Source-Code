<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestExamination extends Model
{
	protected $fillable = ['test_id', 'macroscopics', 'microscopics'];

	public function test()
	{
		return $this->belongsTo('App\Models\Test');

	}
	public function macroscopic()
	{
		return unserialize($this->macroscopics);
	}
	public function microscopic()
	{
		return unserialize($this->microscopics);
	}
    //
}
