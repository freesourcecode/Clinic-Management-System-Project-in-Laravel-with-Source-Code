<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Invoice;
use App\Models\Hospital;
use Auth;
use App\Models\OpdSales;
class OpdController extends Controller
{
	public function getIndex()
	{


		$doctors = Doctor::get();
		$patients = Patient::get();
		$invoice_no = [];
		$invoice = Invoice::orderBy('id', 'desc')->first();
        if($invoice == null)
        {
            $invoice_no = 1;
        }
        else
        {
          $invoice_no = $invoice->id + 1;
        }
		return view('invoices.opd_invoice', compact('doctors', 'patients', 'invoice_no'));
		return $doctors;
	}

	public function store(Request $request)
	{
		//return $request->all();
		$opd = Doctor::find($request->doctor_id);
		$tax_percent = Hospital::first()->tax_percent;
		$sub_total = $opd->opd_charge;

		if($request->discount)
		{
			$discount = $request->discount;
			$sub_total = $sub_total - $discount;		
		}

		$tax_amount = $sub_total * $tax_percent /100;	
		$cash = $request->cash;
		$total_amount = $sub_total + $tax_amount;
		
        $invoice['sub_total'] = $opd->opd_charge;
        $invoice['discount'] = $request->discount;
        $invoice['tax_amount'] = $tax_amount;
        $invoice['total_amount'] = $total_amount;
        $invoice['patient_id'] = $request->patient_id;
        $invoice['invoice_no'] =$request->invoice_no;
        $invoice['comment'] = $request->comment;
        $invoice['payment_type'] = $request->payment_type;
        $invoice['user_id'] = Auth::user()->id;
        $invoice['cash'] = $request->cash;

        $invoices = Invoice::create($invoice); 
        //return $invoices;
        $opd_sale['doctor_id'] = $request->doctor_id;
        $opd_sale['invoice_id'] = $invoices->id;
        $opd_sale['doctor_fee'] = $opd->fee;
        $opd_sale['opd_charge'] = $opd->opd_charge;
        $opd_sale['opd_name'] = 'OPD Charge('.$opd->employee->first_name. ' '.$opd->employee->last_name.')';
        $opd_sale = OpdSales::create($opd_sale);
        $invoices['return'] = $cash - $total_amount;
        $invoices['opd'] = true;
        $invoices['services'] = false;
        $invoices['packages'] = false;
       //return $opd_sale;
        return view('invoices.complete', compact('invoices'));

        

	}


	public function opdSales($doctor_id)
	{
		$doctor = Doctor::find($doctor_id);
		$hospital = Hospital::first();
		$tax_amount = $doctor->opd_charge * $hospital->tax_percent/100;
		//return $tax_amount;
		$total_amount= $doctor->opd_charge + $tax_amount;
		//return $doctor;
		$sn = 0;
		$list = '';
		$list .='<table class="table">
	 		 			<thead>
	 		 				<tr>
	 		 					<th>SN.</th>
	 		 					<th>Particular</th>
	 		 					<th>Opd Charge</th>
	 		 					<th>Remove</th>
	 		 				</tr>
	 		 			</thead>
	 		 			<tbody>';

	 		 			
		$list .='<tr><td>1</td><td>OPD Charge('.$doctor->employee->first_name.' '.$doctor->employee->last_name.')</td><td>Rs.'.$doctor->opd_charge.'</td><td><a href="/opd"><span class="btn-sm btn-danger glyphicon glyphicon-remove"></span></a></button></td></tr>
		<div class="total_field">
		<tr><td></td><td></td><td></td><td>Sub Total:Rs. '.$doctor->opd_charge.'</td></tr>
		<tr><td></td><td></td><td></td><td>HST('.$hospital->tax_percent.'%):Rs. '.$tax_amount.'</td></tr><input type="hidden" id="opd_charge" value="' . $doctor->opd_charge.'"><input type="hidden" id="tax_percent" value="' .$hospital->tax_percent.'">
		<tr class="success"><td></td><td></td><td></td><td >Total Amount:Rs. '.$total_amount.'</td></tr></div>	</tbody>
	 		 				
	 		 			</table>';
		return $list;

	}
    //
}
