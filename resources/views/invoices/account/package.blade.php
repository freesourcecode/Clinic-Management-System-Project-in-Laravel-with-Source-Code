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
@if ($error = Session::get('errors'))        
<div class="alert alert-danger">
            <ul>
               
                <li>{{ $error }}</li>
           
            </ul>
        </div>
    @endif
    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					
						Package Reports
					
					<div class="pull-right">Report From: {{$total['starting_date']}}/{{$total['ending_date']}}</div></div>
					<div class="panel-body">
					<div class="row">
					<form action="{{route('account.package')}}" method="GET">
						<div class="col-md-3">
							<select name="package_id" class="form-control">
								<option value="">Select Package Report:</option>
								@foreach($packages as $package)
									<option value="{{$package->id}}">{{$package->name}}</option>
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
								<th>Particular</th>
								<th>Package Price</th>
								<th>Patient</th>
								<th>User</th>
								<th>Date</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th colspan="2"><b>Total:</b></th>
								<th><b>Rs.{{$total["total"]}}<b></th>
								<th colspan="4"></th>
								

							</tr>
						</tfoot>
						
						<tbody>
						@foreach($invoices as $invoice)
						<tr>
							<td>{{$invoice->invoice->invoice_no}}</td>
							<td>{{$invoice->package->name}}</td>
							<td>Rs.{{$invoice->package_price}}</td>
							<td>Rs.{{$invoice->patient->first_name}}</td>
							<td>{{$invoice->invoice->user->name}}</td>
							<td>{{$invoice->created_at}}</td>
						</tr>
						@endforeach

						<tr>
							<td><b>Total:</b></td>
							<td></td>
							<td>Rs.{{$total['total']}}</b></td>
							<td></b></td>
							<td></td>
							<td></td>
						</tr>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">


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