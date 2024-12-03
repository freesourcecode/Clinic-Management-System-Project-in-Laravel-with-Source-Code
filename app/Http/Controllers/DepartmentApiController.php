<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentApiController extends Controller
{
	public function edit(Request $request)
	{  
        $data = Department::find ( $request->id );
        $data->name = ($request->name);
        $data->description = ($request->description);
        $data->save ();
        return response ()->json ( $data );
    }


    public function toggleStatus($id)
    {
        $department = Department::find($id);

        if($department->status)
        {
           $department->status = 0;
        }
        else
        {

         $department->status = 1;
        }
        $department->save();
        return back();
    }
}
