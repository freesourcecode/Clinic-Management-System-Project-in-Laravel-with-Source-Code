<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceSale;
use App\Models\Service;
use App\Models\OpdSales;
use App\Models\Doctor;
use App\Models\PackageSale;
use App\Models\Package;

class AccountController extends Controller
{
   public function serviceReport(Request $request)
   {


	   	$services = Service::get();
        $user = '';

	    if (count($request->all())) {

	        if ($request->starting_date) {
	            $starting_date = date('Y-m-d '.'00:00:00', strtotime($request->starting_date));

	        }   else {
	          //return'here';
	              $starting_date = date('Y-m-d ' .'00:00:00', time());
	        }

	        if ($request->ending_date) {

	            if ($request->ending_date == date('Y-m-d')) {

	                $ending_date = date('Y-m-d ' .'23:59:59', time());

	            }   else  {

	                $ending_date = date('Y-m-d '.'23:59:59', strtotime($request->ending_date));
	            }   

	        }   else    {

	            $ending_date = date('Y-m-d ' .'23:59:59', time());
	        }
	        
	        if ($request->service_id) {
	         // return $starting_date;
	            $invoices = ServiceSale::where('service_id', $request->service_id)->whereBetween('created_at', array($starting_date, $ending_date) )->get();
	        } else {

	            $invoices = ServiceSale::whereBetween('created_at', array($starting_date, $ending_date))->get();
	        }

	    }   else {

	          $starting_date = '';
	          $ending_date ='';
	          $invoices = ServiceSale::get();
	    }

        $total['total'] = $invoices->sum('amount');
        $total['starting_date'] = $starting_date;
        $total['ending_date'] = $ending_date;
        //return $total;
        return view('invoices.account.service', compact('invoices', 'total', 'services'));
   }

   // OPD sale Report
   public function opdReport(Request $request)
   {


	   	$doctors = Doctor::get();
        $user = '';

	    if (count($request->all())) {

	        if ($request->starting_date) {
	            $starting_date = date('Y-m-d '.'00:00:00', strtotime($request->starting_date));

	        }   else {
	          //return'here';
	              $starting_date = date('Y-m-d ' .'00:00:00', time());
	        }

	        if ($request->ending_date) {

	            if ($request->ending_date == date('Y-m-d')) {

	                $ending_date = date('Y-m-d ' .'23:59:59', time());

	            }   else  {

	                $ending_date = date('Y-m-d '.'23:59:59', strtotime($request->ending_date));
	            }   

	        }   else    {

	            $ending_date = date('Y-m-d ' .'23:59:59', time());
	        }
	        
	        if ($request->doctor_id) {
	         // return $starting_date;
	            $invoices = OpdSales::where('doctor_id', $request->doctor_id)->whereBetween('created_at', array($starting_date, $ending_date) )->get();
	        } else {

	            $invoices = OpdSales::whereBetween('created_at', array($starting_date, $ending_date))->get();
	        }

	    }   else {

	          $starting_date = '';
	          $ending_date ='';
	          $invoices = OpdSales::get();
	    }

        $total['doctor_fee'] = $invoices->sum('doctor_fee');
        $total['opd_charge'] = $invoices->sum('opd_charge');
        $total['starting_date'] = $starting_date;
        $total['ending_date'] = $ending_date;
        //return $starting_date;
        return view('invoices.account.opd', compact('invoices', 'total', 'doctors'));
   }


   // OPD sale Report
   public function packageReport(Request $request)
   {


	   	$packages = Package::get();
	   	//return PackageSale::get();
        $user = '';

	    if (count($request->all())) {

	        if ($request->starting_date) {
	            $starting_date = date('Y-m-d '.'00:00:00', strtotime($request->starting_date));

	        }   else {
	          //return'here';
	              $starting_date = date('Y-m-d ' .'00:00:00', time());
	        }

	        if ($request->ending_date) {

	            if ($request->ending_date == date('Y-m-d')) {

	                $ending_date = date('Y-m-d ' .'23:59:59', time());

	            }   else  {

	                $ending_date = date('Y-m-d '.'23:59:59', strtotime($request->ending_date));
	            }   

	        }   else    {

	            $ending_date = date('Y-m-d ' .'23:59:59', time());
	        }
	        
	        if ($request->doctor_id) {
	         // return $starting_date;
	            $invoices = PackageSale::where('doctor_id', $request->doctor_id)->whereBetween('created_at', array($starting_date, $ending_date) )->get();
	        } else {

	            $invoices = PackageSale::whereBetween('created_at', array($starting_date, $ending_date))->get();
	        }

	    }   else {

	          $starting_date = '';
	          $ending_date ='';
	          $invoices = PackageSale::get();
	    }

        $total['total'] = $invoices->sum('package_price');
       
        $total['starting_date'] = $starting_date;
        $total['ending_date'] = $ending_date;
        //return $starting_date;
        return view('invoices.account.package', compact('invoices', 'total', 'packages'));
   }

   
}
