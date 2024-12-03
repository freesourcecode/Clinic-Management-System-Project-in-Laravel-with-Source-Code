<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestExamination;

class ExaminationController extends Controller
{
    //
    public function index()
    {
    	$tests = Test::where('report_type', 'examination')->get();
        $test_examinations = TestExamination::get();
    	return view('tests.examination', compact('tests', 'test_examinations'));
    }

    public function store(Request $request)
    {
    	$request['macroscopics'] = serialize($request->macroscopic);
        $request['microscopics'] = serialize($request->microscopic);
        //return $request->all();
    	TestExamination::create($request->all());
    	return back()->with('success', 'Examination Test created');
    }

    public function update(Request $request)
    {
        //return $request->all();
        $test = TestExamination::find($request->id);
        $request['macroscopics'] = serialize($request->macroscopic);
        $request['microscopics'] = serialize($request->microscopic);
        $test->update($request->all());
        return back()->with('success', 'Examination test successfully update');
    }
}
