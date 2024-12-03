@extends('layouts.app')
@section('content')
@include('reports.partials.edit')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Patient Report</li>
			</ol>
		</div><br><!--/.row-->
<!-- Modal -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
@if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Report</div>
					<div class="panel-body">
						<table id="example" class="table" cellspacing="0" width="100%">
				    	<thead>
				        <tr>
				            <th>S.N.</th>
				            <th>Report No.</th>
					        <th>Patient Name</th>
					        <th >Register Date:</th>
					        <th >Status</th>
					        <th>Action</th>
						    </tr>
						</thead>
						    <tbody>
						    
						     @foreach($reports as $key => $report)
						    	<tr>
						    	<td>{{ ++$key}}</td>
						    	<td>{{$setting->invoice_prefix.' '.$report->id}}</td>
						    	<td>{{$report->patient->first_name}} {{$report->patient->middle_name}} {{$report->patient->last_name}}
						    	</td>
						    	<td>{{$report->created_at}}</td>
						    	<td>
	                           	@if($report->status)
						    	<span class="btn-sm btn-success glyphicon glyphicon-ok">Complete
						    	</span>
						    	@else
						    	<span class="btn-sm btn-warning glyphicon glyphicon-remove">Waiting</span>
						    	@endif
					    		</td>
					    		
					           	<td>
	                           		<button class="edit-modal btn-sm btn-info" onclick="edit(this.id)" id="{{$report->id}}""><span class="glyphicon glyphicon-edit"></span> Edit
                           	 		</button>
                           	 		 <a href="{{route('report.generate',$report->id)}}" class="btn btn-sm btn-danger" ><span class="glyphicon glyphicon-print"></span>Generate</a>
		                        @if($report->report)
		                            <a class="btn btn-sm btn-warning" href="{{url('/reports/'.$report->report)}}" target="_blank"><span class="glyphicon glyphicon-print"></span> Print</a>
		                        @endif
		                      	</td>
				        </tr>
				    @endforeach
				    </tbody>
					</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
</div><!--/.main-->
<script type="text/javascript">
  function edit(id)
  {
  	$('.edit_report').load({!! json_encode(url('/report/edit'))!!}+'/'+id);
  	$('#edit_report').modal('show');
  }
</script>
@endsection
