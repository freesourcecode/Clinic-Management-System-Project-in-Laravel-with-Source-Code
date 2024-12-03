<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceApiController extends Controller
{
	public function edit(Request $request)
	{  
        $data = Service::find ( $request->id );
        $data->name = ($request->name);
        $data->description = ($request->description);
        $data->save ();
        return response ()->json ( $data );
    }

    public function delete(Request $request)
    {
    	Department::find ($request->id)->delete();
    	return response ()->json ();
    }
    //
}
