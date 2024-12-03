@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Admin</li>
				<li class="active"><a href="/employee">Employee</a></li>
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
                    {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Employee Table
					<a class="btn btn-primary pull-right" data-toggle="modal" href="{{route('employee.create')}}"><span class="glyphicon glyphicon-plus"></span>Add Employee</a></div>
					<div class="panel-body">
						<table id="example" class="table" cellspacing="0" width="100%">
						    <thead>
				        <tr>
				            <th data-sortable="true">ID</th>
					        <th data-sortable="true">Name</th>
					        <th data-sortable="true">Phone</th>
					        <th data-sortable="true">Working Day</th>
					        <th data-sortable="true">In-time</th>
					        <th data-sortable="true">Out-time</th>
					        <th data-sortable="true">Type</th>
					        <th data-sortable="true">Action</th>
						    </tr>
					    </thead>
					    <tbody>
				    	@foreach($employees as $employee)
				        <tr>
				            <td>{{ $employee->id}}</td>
				            <td>{{$employee->first_name}} {{$employee->middle_name}} {{$employee->last_name}}</td>
				           	<td>{{$employee->phone}}</td>
				           	<td>{{$employee->working_day}}</td>
				    		<td>{{$employee->in_time}}</td>
				    		<td>{{$employee->out_time}}</td>
				    		<td>{{$employee->type}}</td>
				            <td>
				             <a class="btn btn-sm btn-primary glyphicon glyphicon-eye-open" href="{{ route('employee.show',$employee->id) }}"> Profile</a>
				            
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
$(document).ready(function() {
  $(".select").select2();
});
</script>
@endsection