<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Service;

class TestController extends Controller
{
	public function index()
	{
		
		$services = Service::get();
		$tests = Test::get();
        $antibiotics = [];
		return view('tests.test', compact('tests', 'services' ));
	}

	public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request, ['name' => 'required|unique:tests']);
        $test = Test::create($request->all());
        return back()->with('success', 'Test saved Successfully.');
    }


	 public function statusChange($id)
    {
        $lab = Test::find($id);

        if($lab->status)
        {
           $lab->status = 0;
        }
        else
        {
         $lab->status = 1;
        }
        $lab->save();
        return back()->with('success', 'Status changed successfully.');
    }

    public function edit(Request $request)
    {
        //return $request->all();
        $this->validate($request, ['name'=>'required']);
        $test = Test::find ( $request->id );
        if ($test->report_type != $request->report_type) {
            
            if ( $test->report_type == 'hematology' or $test->report_type == 'biochemistry') {

                // deattach the relation $test_reference = $test->test_reference_test;
            }

            if ($test->report_type == 'examination') {
                //deattach the relation of test in examination
            } 
            if ( $test->report_type == 'microbiology') {
                //deattach the relation of test in microbiology test
            }
        }

        $test->update($request->all());
        return back()->with('success', 'Test Updated successfully');
        //
    }

    public function delete(Request $request)
    {
       // return $request->all();
        $test = Test::find($request->id);
        if (count($test->test_reference) || count($test->test_reports) || count($test->test_examination) || count($test->test_antibiotics) || count($test->test_stain) ) {
            return back()->with('error', 'Test cannot be deleted...');
        }
        $test->delete();
        return back()->with('success', 'Test successfully Deleted');
      
    }

}
