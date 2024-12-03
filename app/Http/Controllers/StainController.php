<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestStain;
use App\Models\Test;

class StainController extends Controller
{
    public function index()
    {
    	$test_stains = TestStain::get();
    	//return $test_stains->test;
    	$tests = Test::where('report_type', 'stain')->get();
    	return view('tests.stain', compact('test_stains', 'tests'));
    }

    public function store(Request $request)
    {
    	//return $request->all();
        $request['test_names'] = serialize($request->test_name);
    	TestStain::create($request->all());
    	return back()->with('success', 'Stain Test created');
    }

    public function edit(Request $request)
    {
    	//return $request->all();
    	$test_stain = TestStain::find($request->id);
        //return $test_stain;
    	if ($request->test_id) {
    		$data['test_id']= $request->test_id;
    	}
    	$data['test_names'] = serialize($request->test_name);
    	$test_stain->update($data);
    	return back()->with('success', 'Stain Test created');

    }
}
