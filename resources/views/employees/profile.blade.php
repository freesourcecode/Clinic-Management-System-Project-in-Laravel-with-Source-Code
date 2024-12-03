@extends('layouts.app')
@section('content')

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
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
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
	<div class="panel-heading">{{$employee->first_name}} {{$employee->last_name}}
		<a style="margin-left: 5px" class="btn btn-sm btn-primary pull-right" href="{{route('employee.edit', $employee->id)}}"><span class=" glyphicon glyphicon-edit"> </span>Edit Employee</a><a class="btn btn-sm btn-default pull-right" href="{{url('employee')}}">Back <span class="glyphicon glyphicon-share-alt"></span></a>
	</div>
	<div class="panel-body">
				<div class="col-md-6">
					<b>Address: {{$employee->address}}</b><br>
					<b>Phone: {{$employee->phone}}</b><br>
					<label>Email: <a href="mail:to">{{$employee->email}}</a></label><br>
					<label>Education: {{$employee->education}}</label><br>
					<label>Description: {{$employee->description}}</label><br>
					<label>Certificate: {{$employee->certificate}}</label><br>
					<label>Speciality: {{$employee->spciality}}</label><br>
				</div>
				<div class="col-md-6">
				<label>Working Days: {{$employee->working_day}}</label><br>
				<label>Available Time: {{$employee->in_time}} - {{$employee->out_time}}</label><br>
				<label>Department: {{$employee->department->name}}</label><br>
				
				</div>
	</div>
</div>
</div>
</div>
</div>


@endsection