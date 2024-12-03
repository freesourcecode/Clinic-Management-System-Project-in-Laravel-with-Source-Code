<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
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
        $this->validate($request, ['name'=>'required|unique:departments']);
        Department::create($data);
        return back()->with('success', 'Department saved successfully.');
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
        //return $request->all();
        
        $data = Department::find ( $request->id );
        $data->name = ($request->name);
        $data->save ();
        return back()->with('success', 'Department Updated successfully');
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

      //return $request->all();
      $department = Department::find($request->id);
      if(count($department->services) || count($department->employees) || count($department->doctor)) {
        return back()->with('error', 'Department cannot be deleted..');
      } else {
      $department->delete();
      return back()->with('success', 'Department deleted successfully.');
     }
    } 

}
