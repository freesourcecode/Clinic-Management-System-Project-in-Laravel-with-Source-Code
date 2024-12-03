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
			<strong>Patient: </strong>{{$invoice_return->invoice->patient->first_name}} {{$invoice_return->invoice->patient->last_name}}<br>
			<strong>Patient ID: </strong>{{ $setting->patient_prefix}}{{$invoice_return->invoice->patient->id}}<br>
			<strong>Age:</strong>{{ $invoice_return->invoice->patient->age}}<br>
			<strong>Sex:</strong>{{$invoice_return->invoice->patient->gender}}<br>
			<strong>Type:</strong>Return Invoice<br>
	</div>
	<div class="col-md-6" align="right" >
			<strong>Date: </strong>{{$invoice_return->created_at}}<br>
			<strong>Invoice#:</strong>{{$invoice_return->invoice->invoice_no}}<br>
			<strong>Return#:</strong>{{$invoice_return->id}}
	</div>
	
<br><br>
<div class="col-md-12">
	<table class="table">
		<thead>
			<tr>	
				<th>S.N.</th>
				<th>Invoice No.</th>
				<th>Return Amount</th>
				<th>Reason</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<tr>
				<td>{{$i++}}</td>
				<td>{{$invoice_return->invoice->invoice_no}}</td>
				<td>Rs.{{$invoice_return->return_amount}}</td>
				<td>{{$invoice_return->return_reason}}</td>
			</tr>
		</tbody>
	</table>
	</div>
		<div class="col-md-6">
			<strong>User:</strong>{{ $invoice_return->user->username}}<br>
			{{date('Y-m-d')}}
		</div>
	</div>
</div>
<br>
		<div align="center">
		<a href="{{url('invoice/report')}}" class="btn btn-primary" type='button' id='printbtn' onclick="Function()"><span class="glyphicon glyphicon-print"></span> Print</a>
		</div>


<script>
function Function()
{
    window.print(); 
    window.focus();


}
</script>