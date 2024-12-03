<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Employee;
use App\Models\OpdSales;
use App\Models\Hospital;

class doctorController extends Controller
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
        $doctors = Doctor::all();
        $employees = Employee::where('type', 'Doctor')->get();
        //$days = explode(',',$doctors->working_day);
        return view('doctors.index' , compact('doctors', 'employees'));

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
        $this->validate($request, ['employee_id'=>'required']);
        $data = $request->all(); 
        
        $tax = Hospital::first()->tax_percent;

        if($request->with_tax) {

            $tax_cal = 100 + $tax;
            $request['fee'] = $request->fee*100/$tax_cal;
            $request['opd_charge'] = $request->opd_charge*100/$tax_cal;
        }
        //return $data;
        Doctor::create($data);
        return back()->with('success', 'Doctor saved Successfully.');
        //
    }
    public function edit($id)
    {
        //return $id;
        $opd = Doctor::find($id);
        //return $opd;

        if($opd->employee->status == 0)
        {
            $status['status'] = 1;
        }else
        {
            $status['status'] = 0;
        }

        $opd->update($status);

        return back()->with('success', 'Doctor active Successfully');
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
        $doctor = Doctor::find($id);
        $employees = Employee::get();
        return view('doctors.profile', compact('doctor', 'employees'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $doctor = Doctor::find ( $id );

        if($request->with_tax) {

            $tax_cal = 100 + $tax;
            $request['fee'] = $request->fee*100/$tax_cal;
            $request['opd_charge'] = $request->opd_charge*100/$tax_cal;
        }
        
        $doctor->update($request->all());
        $departments = Department::get();
         return back()->with('success', 'Doctor Updated Successfully');
        //
    }

     
    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        if (count($doctor->opd_sales) || count($doctor->reports) || count($doctor->doctor_referred) || count($doctor->appointments) ){
            return back()->with('error', 'Doctor cannot delted..');
        }
        $doctor->delete();
        return redirect()->route('doctor.index')->with('success', 'Doctor Deletetd Successfully');  
     
    } 

}
