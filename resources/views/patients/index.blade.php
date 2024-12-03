@extends('layouts.app')
@section('content')
@include('patients.partials.add')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
				<li>Patient</li>
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
					<div class="panel-heading">Patient Table<a class="btn btn-primary pull-right" data-toggle="modal" href="#addPatient"><span class="glyphicon glyphicon-plus"></span>Add Patient</a></div>
					<div class="panel-body">
						<table id="example" class="table" cellspacing="0" width="100%">
						<thead>
				        <tr>
				            <th >ID</th>
					        <th>Name</th>
					        <th data-sortable="true">Phone</th>
					        <th data-sortable="true">Address</th>
					        <th data-sortable="true">Email</th>
					        <th data-sortable="true">Action</th>
						    </tr>
					    </thead>
					    <tbody>
				    	@foreach($patients as $patient)
				        <tr>
				            <td>{{ $patient->id}}</td>
				            <td>{{$patient->first_name}} {{$patient->middle_name}} {{$patient->last_name}}</td>
				           <td>{{$patient->phone}}</td>
				    		<td>{{$patient->district}}, {{$patient->location}}</td>
				    		<td>{{$patient->email}}</td>
				            <td>
				             <a class="btn btn-sm btn-primary glyphicon glyphicon-eye-open" href="{{ route('patient.show',$patient->id) }}"> Profile</a>
				            
				        </tr>
				    @endforeach
				    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
</div><!--/.main-->


@endsection