<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestReference;


class ReferenceTestController extends Controller
{
	public function index()
	{
		$test_references = TestReference::whereNull('parent_id')->get();
		return view('tests.references', compact('test_references'));
	}

	public function store(Request $request)
    {
       //return $request->all();
        $this->validate($request, ['name'=>'required|unique:test_references']);
         
        TestReference::create($request->all());
        return back()->with('success', 'Test References saved Successfully.');
        //
    }

    public function edit(Request $request)
    {
        //return $request->all();
        $this->validate($request, ['name'=>'required']);
        $data = TestReference::find ( $request->id );
        $data->update($request->all());
        return back()->with('success', 'Test Reference Updated successfully');
        //
    }
    public function delete(Request $request)
    {

     //return $request->all();
      $test = TestReference::find($request->id);


      if(count($test->children) || count($test->test_reference_results)) {
        return back()->with('error', 'Parent test cannot deleted..');
      }
      
      $test->delete();
      return back()->with('success', 'Test Reference deleted successfully.');

    }
}
