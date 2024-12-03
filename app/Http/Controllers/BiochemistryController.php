<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestReference;

class BiochemistryController extends Controller
{
    //
    public function index()
    {
    	$tests = Test::where('report_type', 'biochemistry')->get();
    	$test_references = TestReference::whereNull('parent_id')->get();
    	return view('tests.biochemistry', compact('tests', 'test_references'));
    }

   	public function store(Request $request)
    {
    	//return $request->all();
    	$test = Test::find($request->test_id);
        //return $test->test_references;
    	$test->test_references()->sync($request->test_reference_ids);
    	return back()->with('sucess', 'Test References for Biochemistry created');
    }

}
