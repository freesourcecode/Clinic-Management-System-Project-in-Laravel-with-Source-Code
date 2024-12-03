<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">
<style type="text/css">
	#print {
		
    margin: auto;
    width: 70%;
    border: 3px solid green;
    padding: 10px;
}
@media print {
    #printbtn {
        display :  none;
    }
}
</style>
</style>
<div id="print">
	<div class="row">
	<div class="col-md-12"  align="center">
	<h3>{{$setting->name}}</h3>
			<strong>{{$setting->address}}</strong>
			<address>Phone: {{$setting->contact}}</address>
	</div>
	<div class="col-md-6">
			<strong>Patient: </strong>{{$invoices->patient->first_name}} {{$invoices->patient->last_name}}<br>
			<strong>Patient ID: </strong>{{ $setting->patient_prefix}}{{$invoices->patient->id}}<br>
			<strong>Age:</strong>{{ $invoices->patient->age}}<br>
			<strong>Sex:</strong>{{$invoices->patient->gender}}<br>
			<strong>Payment:</strong> {{$invoices->payment_type}}<br>
	</div>
	<div class="col-md-6" align="right" >
			<strong>Date: </strong>{{$invoices->created_at}}<br>
			<strong>Invoice#:</strong>{{$invoices->invoice_no}}<br><br>
			<b>Duplicate Invoice</b>
	</div>
	
<br><br>
<div class="col-md-12">
	<table class="table">
		<thead>
			<tr>	
				<th>S.N.</th>
				<th>Particular</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 1; ?>
		@if($invoices->services)
		@foreach($invoices->serviceSales()->get() as $sales)
		<tr>
				<td>{{$i++}}</td>
				<td>{{$sales->service_name}}</td>
				<td>Rs.{{number_format($sales->amount, 2)}}</td>
			</tr>
		@endforeach
		@elseif($invoices->opd)
		@foreach($invoices->opd_sales()->get() as $sales)
		<tr>
				<td>{{$i++}}</td>
				<td>{{$sales->opd_name}}</td>
				<td>Rs.{{number_format($sales->opd_charge,2)}}</td>
			</tr>
		@endforeach
		@else
		@foreach($invoices->packageSales()->get() as $sales)
		<tr>
			<td>{{$i++}}</td>
			<td>{{$sales->package->name}}</td>
			<td>Rs.{{number_format($sales->package_price, 2)}}</td>
		</tr>
		@endforeach
		@endif
			
			<tr>
				<td></td><td></td><td><strong>Sub Total: </strong>Rs. {{number_format($invoices->sub_total, 2)}}</td>
			</tr>

			<tr>
				<td></td><td></td><td><strong>Discount: </strong>Rs. {{$invoices->discount}}</td>
			</tr>
			<tr>
				<td></td><td></td><td><strong>HST({{$setting->tax_percent}}%): </strong>RS.{{number_format($invoices->tax_amount,2)}}</td>
			</tr>
			<tr>
				<td></td><td></td><td><strong>Total: </strong>RS.{{number_format($invoices->total_amount)}}</td>
			</tr>
		</tbody>
		
	</table>
	</div>
		<div class="col-md-6">
			<strong>User:</strong>{{ $invoices->user->name}}<br>
			{{date('Y-m-d')}}
		</div>
		<div class="col-md-6" align="right">
			<strong>Cash:</strong> {{ $invoices->cash}}<br>
			----------------------------<br>
			<strong>Return:</strong>  {{ $invoices->return}}<br>	
		</div><br>
		<div class="col-md-12">{{$setting->invoice_message}}</div>
	</div>
</div>
<br>
		<div align="center">
		<a href="{{url('/')}}" class="btn btn-primary" type='button' id='printbtn' onclick="Function()"><span class="glyphicon glyphicon-print"></span> Print</a>
		</div>


<script>
function Function()
{
    window.print(); 
    window.focus();


}
</script>