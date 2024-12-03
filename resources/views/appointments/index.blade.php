@extends('layouts.app')
@section('content')
@include('appointments.partials.add')
@include('appointments.partials.edit')
@include('appointments.partials.js')
<div class="col-lg-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
				<li>Appointment</li>
			</ol>
		</div><br><!--/.row-->
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
					<div class="panel-heading">Appointment Table<a class="btn btn-primary pull-right" data-toggle="modal" href="#addAppointment"><span class="glyphicon glyphicon-plus"></span>Add Appointment</a></div>
					<div class="panel-body">
					@if($appointments->count())
						<table id="example" class="table" cellspacing="0" width="100%">
				    	<thead>
				        <tr>
			            	<th data-sortable="true">ID</th>
					        <th data-sortable="true">Name</th>
					        <th data-sortable="true">Patient Name</th>
					        <th data-sortable="true">Doctor</th>
					        <th data-sortable="true">Description</th>
					        <th data-sortable="true">Time</th>
					        <th>Date</th>
					        <th data-sortable="true">Status</th>
					        <th data-sortable="true">Action</th>
						    </tr>
						</thead>
						    <tbody>
						    @foreach($appointments as $key => $appointment)
						    	<tr>
						    	<td>{{$appointment->id}}</td>
						    	<td>{{$appointment->name}}</td>
						    	<td>{{$appointment->patient->first_name}} {{$appointment->patient->last_name}}</td>
						    	<td>{{$appointment->doctor->employee->first_name}} {{$appointment->doctor->employee->middle_name}} {{$appointment->doctor->employee->last_name}}</td>
						    	<td>{{$appointment->description}}</td>
						    	<td>{{$appointment->time}}</td>
						    	<<td>{{$appointment->appointment_date}}</td>
								<td> 
									@if($appointment->status)
								   	<a class="btn btn-sm btn-success" href="{{ route('appointment.edit',$appointment->id) }}"><span class=" glyphicon glyphicon-ok"></span> Complete</a>	
									@else
									<a class="btn btn-sm btn-warning" href="{{ route('appointment.edit',$appointment->id) }}"><span class=" glyphicon glyphicon-remove"> </span> Pending</a>
									@endif
								</td>
						    	<td><button class="edit-appointment btn btn-info" data-info="{{$appointment->id}},{{$appointment->name}},{{$appointment->description}},{{$appointment->time}},{{$appointment->doctor_id}},{{$appointment->patient_id}} {{$appointment->working_date}}"><span class="glyphicon glyphicon-edit"></span> Edit
                        		</button>
                        		@permission('appointment.delete')
						        <button class="delete-modal btn btn-danger"
						        data-info="{{$appointment->id}}" id="deleteConfirm">
						        <span class="glyphicon glyphicon-trash"></span> Delete
						        </button>
						        @endpermission
						        </td>
						    	</tr>
						    	@endforeach
						    </tbody>
						</table>
						@else
						<h3 align="center">Sorry No appointment Found</h3>
						@endif
					</div>
				</div>
			</div>
		</div><!--/.row-->	
</div><!--/.main-->

@endsection