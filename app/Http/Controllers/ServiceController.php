<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Department;
use App\Models\Tax;
use App\Models\Hospital;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $services = Service::get();
        $departments = Department::select('id','name')->get();
        return view('services.index', compact('services' , 'departments'));
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
       
        $data = $request->all();
        $this->validate($request, ['name'=>'required|unique:services', 'amount'=>'required|numeric' , 'department_id' => 'required']);
         $tax = Hospital::first()->tax_percent;
        if($request->with_tax) {

            $tax_cal = 100 + $tax;
            $request['amount'] = $request->amount*100/$tax_cal;
        }

        Service::create($data);
        return back()->with('success', 'Service saved Successfully.');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
         $tax = Hospital::first()->tax_percent;
        $this->validate($request, ['name'=>'required','amount'=>'required|numeric' , 'department_id' => 'required|numeric']);
        $data = Service::find ( $request->id );
        $data->name = ($request->name);

        if($request->with_tax) {

            $tax_cal = 100 + $tax;
            $request['amount'] = $request->amount*100/$tax_cal;
        }

        $data->amount = ($request->amount);
        $data->department_id = ($request->department_id);
        $data->save ();
        return back()->with('success', 'Service Updated successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {

      $service = Service::find($request->id); 

      if(count($service->service_sales) || count($service->tests)) {

        return back()->with('error', 'Service cannot be deleted...');
      } else {
            $service->delete();
            return back()->with('success', 'Service deleted successfully');
      }
      
     
    } 

}
