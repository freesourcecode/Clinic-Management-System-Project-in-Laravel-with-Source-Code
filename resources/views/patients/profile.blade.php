@extends('layouts.app')
@section('content')
@include('patients.partials.edit')
@include('patients.partials.appointment')
@include('patients.partials.js')

<div class="col-lg-12 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Icons</li>
			<li>Patient Profile</li>
		</ol>
	</div><br><!--/.row-->
	<!-- Modal -->
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif
@if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
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
				<div class="panel-heading">Patient Name: {{$patient->first_name}} {{$patient->middle_name}} {{$patient->last_name}}
				<a class="btn btn-primary pull-right" data-toggle="modal" href="#editPatient"><span class="glyphicon glyphicon-edit"></span> Edit Patient</a></div>
				<div class="panel-body">
				<div class="col-md-6">
				Patient Phone: {{ $patient->phone}}<br>
				Patient Address: {{$patient->location}}, {{$patient->state}}, {{$patient->district}},{{$patient->country}}<br>
				@if($patient->relative_name)
				Relatives Name: {{$patient->relative_name}}<br>
				Relative Phone: {{$patient->relative_phone}}<br>
				@endif
				Age: {{$patient->age}}<br>
				Blood Group: {{$patient->blood_group}}<br>
				</div>
				<div class="col-md-6">
				<b>Gender: </b> {{$patient->gender}}<br>
				<b>DOB: </b> {{$patient->birth_date}}<br>
				</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Patient Appointment
				<a class="btn btn-primary pull-right" data-toggle="modal" href="#addAppointment"><span class="glyphicon glyphicon-plus"></span>Add Appointment</a></div>
				<div class="panel-body">
				@if($patient->appointments->count())
				<table id="example" class="table" cellspacing="0" width="100%">
				   	 	<thead>
				        <tr>
				        	<th data-sortable="true">ID</th>
				            <th data-sortable="true">Appointment Name</th>
					        <th data-sortable="true">Doctor Name</th>
					        <th data-sortable="true">Description</th>
					        <th data-sortable="true">Time</th>
					        <th>Status</th>
					        <th data-sortable="true">Action</th>

						    </tr>
					    </thead>
					    <tbody>
					   
					    @foreach( $patient->appointments()->get() as $appointment)
					    <tr>
					    <td>{{$appointment->id}}</td>
					    <td>{{$appointment->name}}</td>
					    <td>{{$appointment->doctor->employee->first_name}} {{$appointment->doctor->employee->last_name}}</td>
					    <td>{{$appointment->description}}</td>
					    <td>{{$appointment->time}}</td>
					    <td>
					    @if($appointment->status)
					   	<a class="btn-sm btn-success" href="{{ route('appointment.edit',$appointment->id) }}"><span class=" glyphicon glyphicon-ok"></span> Complete</a>	
						@else
						<a class="btn-sm btn-warning" href="{{ route('appointment.edit',$appointment->id) }}"><span class=" glyphicon glyphicon-remove"> </span> Pending</a>
						@endif
					   </td>
					   <td> <a class="btn-sm btn-info" href="{{ route('appointment.index')}}"><span class=" glyphicon glyphicon-eye-open"> </span> View all..</a>
                       </td>
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

			<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Patient Report</div>
				<div class="panel-body">
				@if($patient->reports->count())
				<table id="example" class="table" cellspacing="0" width="100%">
				   	 	<thead>
				        <tr>
				        	<th data-sortable="true">ID</th>
				            <th data-sortable="true">Report Name</th>
					        <th data-sortable="true">Status</th>
					        <th data-sortable="true">Action</th>
					    </tr>
					    </thead>
					    <tbody>
					   
					    @foreach( $patient->reports()->get() as $report)
					    <tr>
					    <td>{{$report->id}}</td>
					    <td>{{$report->report}}</td>
					   @if($report->status)
					    <td><span class="btn-sm btn-primary glyphicon glyphicon-ok">  Complete</span> </td>
					    @else
					    <td><span class="btn-sm btn-warning glyphicon glyphicon-remove">Pending </span> </td>
					    @endif
					   @if($report->report)
					    <td><a href="{{url('/reports/'.$report->report) }}" class="btn-sm btn-success" target="_blank"><span class=" glyphicon glyphicon-print">Print</a></td>
					    @else
					    <td>Not Available</td>
					    @endif
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



<script>
        $(document).ready( function() {
            $('#doctorId').on('change', function() {
                var id = $('#doctorId').val();
                //ajax
              $('#available_time').load({!! json_encode(url('/days/')) !!}+'/'+id);
            });
             $( "#datepicker" ).datepicker();
                $('#datepicker').change(function(){
                	$("#datepicker").datepicker('hide')
                });
        });
    </script>


@endsection