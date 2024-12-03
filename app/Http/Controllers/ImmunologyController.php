<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestReference;

class ImmunologyController extends Controller
{
    //
    public function index()
    {
    	$tests = Test::where('report_type', 'immunology')->get();
    	$test_references = TestReference::whereNull('parent_id')->get();
    	return view('tests.immunology', compact('tests', 'test_references'));
    }

    public function store(Request $request)
    {
    	//return $request->all();
    	$test = Test::find($request->test_id);
        $test->test_references()->sync($request->test_reference_ids);
        $test->update($request->all());
    	return back()->with('success', 'Test References for Immunology created');
    }

}
