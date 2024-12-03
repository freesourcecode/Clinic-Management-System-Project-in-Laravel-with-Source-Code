@extends('layouts.app')
@section('content')
@include('doctors.partials.edit')

<div class="col-md-12 main">   
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Icon</li>
		<li> Profile </li>
	</ol>
</div><br>
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
                <button type="button" class="close" data-dismiss="alert">×</button>
            @endforeach
        </ul>
</div>
@endif

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
	<div class="panel-heading">{{$doctor->employee->first_name}} {{$doctor->employee->last_name}}
		<a style="margin-left: 8px" class="btn btn-sm btn-primary pull-right" data-toggle="modal" href="#editDoctor"><span class="glyphicon glyphicon-edit"></span> Edit Doctor</a><a class="btn btn-sm btn-default pull-right" href="{{url('doctor')}}">Back <span class="glyphicon glyphicon-share-alt"></span></a>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<b>Address: {{$doctor->employee->address}}</b><br>
			<b>Phone: {{$doctor->employee->phone}}</b><br>
			<label>Email: <a href="mail:{{$doctor->email}}">{{$doctor->employee->email}}</a></label><br>
			<label>Education: {{$doctor->employee->education}}</label><br>
			<label>Description: {{$doctor->employee->description}}</label><br>
			<label>Certificate: {{$doctor->employee->certificate}}</label><br>
			<label>Speciality: {{$doctor->employee->spciality}}</label><br>
		</div>
		<div class="col-md-6">
		<label>Working Days: {{$doctor->employee->working_day}}</label><br>
		<label>Available Time: {{$doctor->employee->in_time}} - {{$doctor->employee->out_time}}</label><br>
		<label>Department: {{$doctor->employee->department->name}}</label><br>
		
		</div>
</div>
</div>
</div>
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Doctor OPD Report
			<a class="btn btn-sm btn-primary pull-right" data-toggle="modal" href="#addAppointment"><span class="glyphicon glyphicon-plus"></span>ADD OPD</a></div>
			<div class="panel-body">
			@if($doctor->opd_sales()->count())
			<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
				<thead>
			<tr>
			<th data-sortable="true">No.</th>
			<th data-sortable="true">Patient Name</th>
			<th data-sortable="true">Doctor Fee</th>
			<th data-sortable="true">Action</th>
			</tr>
			</thead>
			<tbody>
			<?php $i = 1;?>
			@foreach($doctor->opd_sales()->get() as $sales)
			<tr>
			<td>{{$i++}}</td>
			<td>{{$sales->invoice->patient->first_name}} {{$sales->invoice->patient->middle_name}} {{$sales->invoice->patient->last_name}}</td>
			<td>{{$doctor->fee}}</td>
			<td>COmplete</td>
			</tr>
			@endforeach

			</tbody>

			</table>

			@else
			<h1>No record Found..</h1>
			@endif
</div>
</div>
</div>
</div>
</div>
 <div class="modal fade" id="doctor_delete"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Delete Doctor</h4>
      </div>
       {!! Form::open(['method' => 'DELETE','route' => ['doctor.destroy', $doctor->id]]) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="delete_id">
      	<label>Are your sure want to delete this doctor?</label>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> No</button>
           <button class="btn btn-danger" type="submit"><span class='glyphicon glyphicon-remove'></span> Yes</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>

<script type="text/javascript">
	$('#delete_doctor').click(function()
	{
		$('#doctor_delete').modal('show');
		$('#editDoctor').modal('hide');
		
	})
</script>
@endsection