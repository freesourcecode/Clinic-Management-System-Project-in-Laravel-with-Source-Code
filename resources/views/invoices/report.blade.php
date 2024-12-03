@extends('layouts.app')
@section('content')
<div class="col-sm-12  main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Invoice Report</li>
			</ol>
		</div><br><!--/.row-->
<!-- Modal -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
@if ($error = Session::get('error'))        
<div class="alert alert-danger">
            <ul>
               {{ $error }}
            </ul>
        </div>
    @endif
    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Total Collection</div>
					<div class="panel-body">
					<div class="row">
					<form action="{{route('search.invoice')}}" method="GET">
						<div class="col-md-3">
							<select name="user_id" class="form-control">
								<option value="">Select User Report:</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3">
							<input type="text" class="datepicker form-control" placeholder="From Date" name="starting_date" data-date-end-date="0d" >
						</div>

						<div class="col-md-3">
							<input type="text" class="datepicker1 form-control" placeholder="To Date" name="ending_date" data-date-end-date="0d" >
						</div>
						<div class="col-md-3">
							<button class="btn btn-danger"><span class="glyphicon glyphicon-search"></span>Search Report</button>
						</div>
					</form>
					</div>
					</div>
					<div class="panel-footer">

					<table id="dataPrint" class="table" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Invoice No</th>
								<th>Payment</th>
								<th>Sub Total</th>
								<th>Discount</th>
								<th>Tax Amount</th>
								<th>Total Amount</th>
								<th>Date</th>
								<th>Return</th>
								
								<th>Duplicate</th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($invoices as $invoice)
							<tr>
							<td>{{$invoice->invoice_no}}</td>
							<td>{{$invoice->payment_type}}</td>
							<td>Rs.{{number_format($invoice->sub_total, 2)}}</td>
							<td>Rs.{{$invoice->discount}}</td>
							<td>Rs.{{number_format($invoice->tax_amount, 2)}}</td>
							<td>Rs.{{number_format($invoice->total_amount, 2)}}</td>
							<td>{{$invoice->created_at}}</td>
							@if ($invoice->invoiceReturns()->get()->count())
								@foreach($invoice->invoiceReturns()->get() as $return)
									<td>Return: Rs.{{$return->return_amount}}</td>
								@endforeach
							@else
							<td><a class="btn btn-sm btn-primary invoiceReturn" data-return="{{$invoice->id}}, {{$invoice->invoice_no}}, {{number_format($invoice->total_amount)}}"><span class="glyphicon glyphicon-share-alt"></span>Return Bill</a>
							</td>
							@endif
							
							<td>
								<a href="{{route('invoice.duplicate', $invoice->id)}}" class=" btn-sm btn btn-primary">Re-Print Bill</a>
							</td>
							
							</tr>
						@endforeach
						</tbody>
						<tr>
							<th>Total:</td>
							<th></th>
							<th>Rs.{{number_format($total['sub_total'], 2)}}</th>
							<th>Rs.{{$total['discount']}}</th>
							<th>Rs.{{number_format($total['tax_amount'], 2)}}</th>
							<th>Rs.{{number_format($total['total_amount'], 2)}}</th>
							
							<td>Complete</td>
						</tr>
						
						
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="modal fade" id="returnInvoice" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width:50%">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Return Invoice</h4>
      </div>
      {!! Form::open(array('route' => 'invoice.return','method'=>'POST')) !!}
      <div class="modal-body">
      <div class="row">
      <input type="hidden" name="id" id="id">
	      	<div class="col-md-12 form-group">
	      	<label>Invoice No:</label>
	      		<input type="text" name="invoice_no" id="invoice_no" disabled="" class="form-control">
	      	</div>

	      	<div class="col-md-12 form-group">
	      		<label>Invoice Amount(RS.):</label>
	      		<input type="text" name="amount" id="amount" readonly="" class="form-control">
	      	</div>

	      	<div class="col-md-12 form-group">
      			<label>Return Amount:</label>
      			<input type="number" name="return_amount"  required="" class="form-control">
      		</div>

      		<div class="col-md-12 form-group">
      			<label>Return Reason:</label>
      			<input type="text" name="reason"  required="" class="form-control">
      		</div>
      </div>
       <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          <button class="btn " type="reset">Reset</button>
           <button class="btn btn-primary" type="submit">Save changes</button>
    </div>
    {{Form::close()}}
  </div>
<script type="text/javascript">
	$(document).ready(function() {
    	$('.invoiceReturn').on('click', function() {
	        $('#returnInvoice').modal('show');
	        var stuff = $(this).data('return').split(',');
	        fillmodalData(stuff)
    	});
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#invoice_no').val(details[1]);
        $('#amount').val(details[2]);
    }

    $(document).ready(function() {
    $('#dataPrint').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'excel', 'pdf', 'print'
        
        ]

    } );
} );

</script>
@endsection