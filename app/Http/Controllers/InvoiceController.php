<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Patient;
use App\Models\Temp;
use App\Models\Hospital;
use App\Models\ServiceSale;
use App\Models\Test;
use App\Models\User;
use App\Models\Doctor;
use App\Models\DoctorReferred;
use App\Models\Report;
use App\Models\TestReport;
use App\Models\InvoiceReturn;

use Auth;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::get();
        $patients = Patient::get();
        $invoice = Invoice::orderBy('id', 'desc')->first();
        Temp::truncate();
        $invoice_no = [];
        if($invoice == null)
        {
            $invoice_no = 1;
        }
        else
        {
          $invoice_no = $invoice->id + 1;
        }
        $doctors = Doctor::get();
        //return $invoice;
        return view('invoices.index', compact('services', 'invoice_no', 'patients' , 'doctors'));
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
        //return $request->all();
        $temp_sales = Temp::get();

        if (count($temp_sales)) {
       
        $sub_total = $temp_sales->sum('amount');
        $tax_percent = Hospital::first()->tax_percent;

        if($request->discount)
        {
            $discount = $request->discount;
            $sub_total = $sub_total - $discount;        
        }

        $tax_amount = $sub_total * $tax_percent /100;   
        $cash = $request->cash;
        $total_amount = $sub_total + $tax_amount;
        
        $invoice['sub_total'] = $temp_sales->sum('amount');
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

        if($request->doctor_id)
        {
          $doctor_referred['doctor_id'] = $request->doctor_id;
          $doctor_referred['invoice_id'] = $invoices->id;
          //return $doctor_referred;
          DoctorReferred::create($doctor_referred);
          $report['doctor_id'] = $request->doctor_id;
        }

        $service_sales = [];
        foreach ($temp_sales as $key) 
        {
            $service_sales['invoice_id'] = $invoices->id;
            $service_sales['service_id'] = $key->service_id;
            $service_sales['service_name'] = $key->service_name;
            $service_sales['amount'] = $key->amount;
            $service = ServiceSale::create($service_sales);  

        }
        // Report Register
        $temp_tests = [];
        foreach($temp_sales as $service)
        {
              $test = Test::where('service_id', $service->service_id)->first();
              //return $test;
              if($test)
              {
                $temp_tests[] = $test->id;
              }
        }
       
        if($test)
          {
            $report['patient_id'] = $request->patient_id;
            //return $report;
            $report = Report::create($report);
            $test_report['report_id'] = $report->id;
            //$list = '';
            foreach($temp_tests as $temp_test)
            {
              
              $test_report['test_id'] = $temp_test;
              $test_report['report_type'] = Test::find($temp_test)->report_type;
              TestReport::create($test_report);
              
            }
            $invoices['report_id'] = $report->id;
         
        }
        Temp::truncate();
        $invoices['return'] = $cash - $total_amount;
        $invoices['opd'] = false;
        $invoices['services'] = true;
        $invoices['packages'] = false;

       return view('invoices.complete', compact('invoices'));
     }
     return back();
    }


    public function tempSales($service_id)
    {

        $service = Service::find($service_id);
        $hospital = Hospital::first();
        //return $service;
        $temp = [];

        $temp['service_id'] = $service->id;
        $temp['service_name'] = $service->name;
        $temp['amount'] = $service->amount;
        //return $temp;
        Temp::create($temp);
        $temp_sales = Temp::get();
        //return $temp_sales;
        $sub_total = $temp_sales->sum('amount');
        //return $sub_total;
        $tax_amount = $sub_total * $hospital->tax_percent/100;
        $total_amount = $sub_total + $tax_amount;
       // return $total_amount;
        $list = '';
             $list .= "<table class='table'>
                    <tr><th>Service ID</th><th>Service Name</th>
                            <th>Amount</th><th>Remove</th></tr>";

        foreach ($temp_sales as $key => $temp_sale)
        {
             $list .= '<td>'.$temp_sale->service_id.'</td>';
             $list .= '<td>'.$temp_sale->service_name.'</td>';
             $list .= '<td>RS.'.$temp_sale->amount.'</td>';
             $list .= '<td><button class="btn-danger glyphicon glyphicon-remove"  onclick="del(this.id);return false;" id="'.$temp_sale->id.'"></button"</td>';
             $list .= '</tr>';
        }
          $list .= '<tr><th></th><th></th><th></th><th>Sub Total:'.number_format($sub_total, 2).'</th></tr>
       <tr><td></td><td></td><td></td><td>HST('.$hospital->tax_percent.'%):Rs. '.number_format($tax_amount, 2).'</td></tr><input type="hidden" id="sub_total" value="' . $sub_total.'"><input type="hidden" id="tax_percent" value="' .$hospital->tax_percent.'">
        <tr class="success"><td></td><td></td><td></td><td >Total Amount:Rs. '.number_format($total_amount).'</td></tr></div>  </tbody>
                            
                        </table>';
       

        return $list;
    }

    public function patient($patient_id)
    {
        $patient = Patient::find($patient_id);
        $list = '';
        $list = ' <strong>Patient Name: </strong> <input type="text" class="form-control" value="' . $patient->first_name.' '.  $patient->last_name. '" readonly>';
        return $list;

    }

    public function remove($id)
    {
        $service = Temp::find($id);
        //return $service;
        $hospital = Hospital::first();
        //return $service;
        $service->delete();
        $temp_sales = Temp::get();
        //return $temp_sales;
        $sub_total = $temp_sales->sum('amount');
        //return $sub_total;
        $tax_amount = $sub_total * $hospital->tax_percent/100;
        $total_amount = $sub_total + $tax_amount;
       // return $total_amount;
        $list = '';
             $list .= "<table class='table'>
                    <tr><th>Service ID</th><th>Service Name</th>
                            <th>Amount</th><th>Remove</th></tr>";

        foreach ($temp_sales as $temp_sale)
        {
             $list .= '<td>'.$temp_sale->service_id.'</td>';
             $list .= '<td>'.$temp_sale->service_name.'</td>';
             $list .= '<td>RS.'.$temp_sale->amount.'</td>';
             $list .= '<td><button class="btn-danger glyphicon glyphicon-remove"  onclick="del(this.id);return false;" id="'.$temp_sale->id.'"></button"</td>';
             $list .= '</tr>';
        }
       $list .= '<tr><th></th><th></th><th></th><th>Sub Total:'.number_format($sub_total, 2).'</th></tr>
       <tr><td></td><td></td><td></td><td>HST('.$hospital->tax_percent.'%):Rs. '.number_format($tax_amount, 2).'</td></tr><input type="hidden" id="sub_total" value="' . $sub_total.'"><input type="hidden" id="tax_percent" value="' .$hospital->tax_percent.'">
        <tr class="success"><td></td><td></td><td></td><td >Total Amount:Rs. '.number_format($total_amount).'</td></tr></div>  </tbody>
                            
                        </table>';
       

        return $list;

    }

    public function calculate(Request $request)
    {
        $temp_sales = Temp::get();
        //return $temp_sales;
        $sub_total = $temp_sales->sum('amount');
        //return $sub_total;
        $tax_amount = $sub_total * 0.05;
        $total_amount = $sub_total + $tax_amount;

        $cash = $request->cash;
        $data['tender_amount'] =  $cash - $total_amount;
        $data['tax_amount'] = $tax_amount;
        $data['cash'] = $cash;
        return response ()->json ( $data );
    }

    public function report()
    {
      $users = User::get();
      $invoices = Invoice::get();
      $total['sub_total'] = $invoices->sum('sub_total');
      $total['discount'] = $invoices->sum('discount');
      $total['tax_amount'] = $invoices->sum('tax_amount');
      $total['total_amount'] = $invoices->sum('total_amount');
       //return $total;
      return view('invoices.report', compact('invoices', 'total', 'users'));

    }

    public function invoiceReturn(Request $request)
    {
      //return $request->all();
      $invoice = Invoice::find($request->id);
      $this->validate($request, ['return_amount' => 'numeric']);

      if ($invoice->invoiceReturns()->get()->count()) {
        return back()->with('error', 'Invoice No is already returned...');
      }

      if ($request->return_amount > $invoice->total_amount)
      {
        return back()->with('error', 'Return amount is maximum...');
      }
      else
      {
        $data['invoice_id'] = $invoice->id;
        $data['return_amount'] = $request->return_amount;
        $data['return_reason'] = $request->reason;
        $data['user_id'] = Auth::user()->id;
        $invoice_return = InvoiceReturn::create($data);
        return view('invoices.return', compact('invoice_return'));
      }
      
    }


    public function searchInvoice(Request $request)
    {

        $users = User::get();
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
                  
              if ($request->user_id) {
                  // return $starting_date;
                  $invoices = Invoice::where('user_id', $request->user_id)->whereBetween('created_at', array($starting_date, $ending_date) )->get();
                  $user = User::find($request->user_id);

              } else {

                    $invoices = Invoice::whereBetween('created_at', array($starting_date, $ending_date))->get();
              }

        }   else {

          $starting_date = '';
          $ending_date ='';
          $invoices = Invoice::get();
        }
            //return $service_sales; 

        $total['starting_date'] = $starting_date;
        $total['ending_date'] = $ending_date;
        $total['sub_total'] = $invoices->sum('sub_total');
        $total['discount'] = $invoices->sum('discount');
        $total['tax_amount'] = $invoices->sum('tax_amount');
        $total['total_amount'] = $invoices->sum('total_amount');


        return view('invoices.search', compact('invoices', 'users', 'total', 'user'));
    }

    public function duplicate($id)
    {
      $invoices = Invoice::find($id);
      return view('invoices.duplicate', compact('invoices'));
    }
}
                            