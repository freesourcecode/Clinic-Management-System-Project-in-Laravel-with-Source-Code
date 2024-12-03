<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;

class PatientController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::get();
        return view('patients.index' , compact('patients'));

        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //return $data;
        $this->validate($request, []);
        $data = $request->all();
        //return $data;
        Patient::create($data);
        return back()->with('success', 'Patient saved Successfully.');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        //return $patient->appointments()->get();
        $doctors = Doctor::get();
        return view('patients.profile' , compact('patient', 'doctors'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);

        if($patient->status)
        {
           $patient->status = 0;
        }
        else
        {

         $patient->status = 1;
        }
        $patient->save();
        return back()->with('success', 'Status changed successfully.');
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        $data = $request->all();
        $patient->update($data);
        return back()
            ->with('success', 'Patient updated successfully');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id); 
        if (count($patient->invoices) || count($patient->reports) || count($patient->packageSales) ) {
            return back()->with('error', 'Patient cannot deleted...');
        }
        $patient->delete();
        return redirect()->route('patient.index')->with('success', 'Patient Deletetd Successfully');  
        //
    }
}
