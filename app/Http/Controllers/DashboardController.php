<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\OpdSales;
use App\Models\Test;
use App\Models\Doctor;
use Auth;


class DashboardController extends Controller
{
    //define constructor with middleware

    public function __construct()
    {
    	$this->middleware('auth');

    }

    public function index()
    {
    	  $user = Auth::user()->id;
      	$invoices = Invoice::where('user_id', $user)->whereDate('created_at', '=', date('Y-m-d'))->get();
        $patients = Patient::get();
        $appointments = Appointment::whereDate('appointment_date', '=', date('Y-m-d'))->get();
        $opds = OpdSales::whereDate('created_at' , '=', date('Y-m-d'))->get();
      	//return $invoices;
      	$total['sub_total'] = $invoices->sum('sub_total');
      	$total['discount'] = $invoices->sum('discount');
     	  $total['tax_amount'] = $invoices->sum('tax_amount');
      	$total['total_amount'] = $invoices->sum('total_amount');
      	// Appointment
        $pending['appointment'] = Appointment::where('status', 0)->count();
        $total_doctor = Doctor::get()->count();
        $total_test = Test::get()->count();
      

    	return view('dashboard' , compact('invoices', 'total' ,'appointments','patients' , 'pending' , 'opds', 'total_doctor', 'total_test'));

    }
}
