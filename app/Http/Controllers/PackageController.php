<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Test;
Use App\Models\PackageTest;
use App\Models\Patient;
use App\Models\Invoice;
use App\Models\Hospital;
use App\Models\Report;
use App\Models\TestReport;
use App\Models\PackageSale;
use Auth;

class PackageController extends Controller
{

	public function getIndex()
	{
		$packages = Package::get();
		//return $package_test;
		$tests = Test::get();
		//return $tests;
		return view('packages.index', compact('packages', 'tests'));
	}

	public function store(Request $request)
	{
		//return $request->all();
		$this->validate($request, ['price' => 'required|numeric']);
		$package['name'] = $request->name;
		$package['description'] = $request->description;
		$package['price'] = $request->price;

		$tax = Hospital::first()->tax_percent;

        if($request->with_tax) {

            $tax_cal = 100 + $tax;
            $request['price'] = $request->amount*100/$tax_cal;
        }

		$package = Package::create($package);
		//return $package;
		$tests = $request->test_id;
		foreach ($tests as $test) {
			$data['test_id'] = $test;
			$data['package_id'] = $package->id;
			PackageTest::create($data);
		}
		return back()->with('success', 'Package Created Successfully.');

	}  
	public function edit(Request $request)
	{
		//return $request->all();
		$package = Package::find($request->id);
		$data['name'] = $request->name;
		$data['price'] = $request->price;
		$data['description'] = $request->description;
		$tax = Hospital::first()->tax_percent;

        if($request->with_tax) {

            $tax_cal = 100 + $tax;
            $request['price'] = $request->amount*100/$tax_cal;
        }

		
		$package->update($data);

		$tests = $request->test_id;
		if($tests)
		{
			foreach ($tests as $test) {
				$data['test_id'] = $test;
				$data['package_id'] = $package->id;
				PackageTest::create($data);
			}
		}

		return back()->with('success', 'Package Updated Successfully.');

	}  //

	public function packageTestDelete(Request $request)
	{
		//return $request->all();
		$package_test = PackageTest::find($request->id);
		if($package_test) {
			$package_test->delete();
		}
		return back()->with('success', 'Package Test Deleted Successfully.');
	}


	 public function delete(Request $request)
	 {
	 	//return $request->all();
	 	$package = Package::find($request->id);

	 	if(count($package->packageSales)) {
	 		return back()->with('error', 'Package cannot deleted..');
	 	}
	 	$package->delete();
	 	return back()->with('success', 'Package Deleted Successfully.');
	 }

	 public function sale()
	 {

	 	$packages = Package::all();
	 	$patients = Patient::all();
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
	 	return view('invoices.package_invoice', compact('packages','patients', 'invoice_no'));
	 }


	 public function packageSale(Request $request)
	 {

	 	$package = Package::find($request->package_id);
	 	$tax_percent = Hospital::first()->tax_percent;
		$sub_total = $package->price;

		if($request->discount)
		{
			$discount = $request->discount;
			$sub_total = $sub_total - $discount;		
		}

		$tax_amount = $sub_total * $tax_percent /100;	
		$cash = $request->cash;
		$total_amount = $sub_total + $tax_amount;
		
        $invoice['sub_total'] = $package->price;
        $invoice['discount'] = $request->discount;
        $invoice['tax_amount'] = $tax_amount;
        $invoice['total_amount'] = $total_amount;
        $invoice['patient_id'] = $request->patient_id;
        $invoice['invoice_no'] =$request->invoice_no;
        $invoice['comment'] = $request->comment;
        $invoice['payment_type'] = $request->payment_type;
        $invoice['user_id'] = Auth::user()->id;
        $invoice['cash'] = $request->cash;
        //return $invoice;

       $invoices = Invoice::create($invoice); 

        $package_sale['patient_id'] = $request->patient_id;
        $package_sale['package_id'] = $request->package_id;
        $package_sale['invoice_id'] = $invoices->id;
        $package_sale['package_price'] = $package->price;
        //return $package_sale;
        $package_sale = PackageSale::create($package_sale);

        

        $report['patient_id'] = $request->patient_id;
       
        //return $report;
        $report = Report::create($report);
        $test_report['report_id'] = $report->id;
       	$package_tests =  $package->packageTests()->get();
       	//return $package_tests;
        foreach($package_tests as $tests)
        {
            $test_report['test_id'] = $tests->test_id;
            $test_report['report_type'] = $tests->test->report_type;
            TestReport::create($test_report);
            //$list .= $temp_test;
        }
        //return $test_report;

        $invoices['return'] = $cash - $total_amount;
        $invoices['opd'] = false;
        $invoices['services'] = false;
        $invoices['packages'] = true;
        return view('invoices.complete', compact('invoices'));

	 }



	 public function packageSales($package_id)
	{
		$package = Package::find($package_id);
		$hospital = Hospital::first();
		$tax_amount = $package->price * $hospital->tax_percent/100;
		//return $tax_amount;
		$total_amount= $package->price + $tax_amount;
		//return $doctor;
		$sn = 0;
		$list = '';
		$list .='<table class="table">
	 		 			<thead>
	 		 				<tr>
	 		 					<th>SN.</th>
	 		 					<th>Particular</th>
	 		 					<th>Amount</th>
	 		 					<th>Remove</th>
	 		 				</tr>
	 		 			</thead>
	 		 			<tbody>';

	 		 			
		$list .='<tr><td>1</td><td>'.$package->name.'</td><td>Rs.'.$package->price.'</td><td><a href="/package/sale"><span class="btn-sm btn-danger glyphicon glyphicon-remove"></span></a></button></td></tr>
		<div class="total_field">
		<tr><td></td><td></td><td></td><td>Sub Total:Rs. '.$package->price.'</td></tr>
		<tr><td></td><td></td><td></td><td>HST('.$hospital->tax_percent.'%):Rs. '.$tax_amount.'</td></tr><input type="hidden" id="package_charge" value="' . $package->price.'"><input type="hidden" id="tax_percent" value="' .$hospital->tax_percent.'">
		<tr class="success"><td></td><td></td><td></td><td >Total Amount:Rs. '.$total_amount.'</td></tr></div>	</tbody>
	 		 				
	 		 			</table>';
		return $list;

	}
}
