<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestAntibiotic;

class MicrobiologyController extends Controller
{
    //
    public function index()
    {
    	$tests = Test::where('report_type', 'microbiology')->get();
    	$test_antibiotics = TestAntibiotic::get();
        //return $test_antibiotics;
    	return view('tests.microbiology', compact('tests', 'test_antibiotics'));
    }

    public function store(Request $request)
    {
    	//return $request->all();
    	$test = Test::find($request->test_id);
    	$test->test_antibiotics()->sync($request->test_antibiotics_ids);
    	return back()->with('sucess', 'Test Antibiotics for Microbilogy created');
    }

    public function storeAntibiotic(Request $request)
    {
        //return $request->name;
        $this->validate($request, ['name'=>'required|unique:test_antibiotics']);
        TestAntibiotic::create($request->all());
        return back()->with('success', 'Test Antibiotic created successfully');
    }

    public function editAntibiotic(Request $request)
    {
        //return $request->all();
        $antibiotic = TestAntibiotic::find($request->id);
        $this->validate($request, ['name'=>'required']);
        $antibiotic->update($request->all());
        return back()->with('success', 'Test Antibiotic updated successfully');
    }
}
