<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
class DoctorApiController extends Controller
{

	public function getDays($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        $days = explode(',',$doctor->employee->working_day);

		// return  response ()->json ( $data );
		$available_time = $doctor->employee->in_time .'-'. $doctor->employee->out_time;
        $list = '';
        //$list .= '<label>Menu Item:</label>';
        $list .= '<select class ="form-control" name="time">';
        foreach ($days as $day) 
        {
        	//return $day;
        	$list .= ' <option class="form-control">' . $day .'  ' . $available_time .'</option>';

        }
        return $list;
    }
    //
}
