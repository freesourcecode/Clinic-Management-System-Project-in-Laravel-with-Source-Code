@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Admin</li>
				<li class="active"><a href="{{route('employee.index')}}"> Employee</a></li>
			</ol>
		</div><br><!--/.row-->
<!-- Modal -->
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
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Add Employee
					<a class="btn btn-primary pull-right" href="{{route('employee.index')}}"><span class="glyphicon glyphicon"></span>Back</a></div>
					<div class="panel-body">
          			
      				<div class="container">
		      	{!! Form::open(array('route' => 'employee.store','method'=>'POST')) !!}
		      	<div class="row">
		      	<div class=" col-md-4 form-group">
					<label>First Name:</label>
				 	{!! Form::text('first_name', null, array('class' => 'form-control', 'required'=>'required')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Middle Name:</label>
				 	{!! Form::text('middle_name', null, array('class' => 'form-control')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Last Name:</label>
				 	{!! Form::text('last_name', null, array('class' => 'form-control', 'required'=>'required')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Email:</label>
				 	{!! Form::email('email', null, array('class' => 'form-control')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Phone:</label>
				 	{!! Form::input('number','phone' ,null, array('class' => 'form-control', 'required'=>'required')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Type:</label>
				 	<select class="form-control" name="type" required>
				 	<option></option>
				 	<option>Doctor</option>
				 	<option>Laboratory</option>
					<option>Reception</option>
					<option>Pharmacy</option>
					<option>Acountant</option>
					<option>Nurse</option>	
					<option>Other</option>
				 	</select>
				</div>
				<div class=" col-md-4 form-group">
					<label>In-Time:</label>
				 	{!! Form::text('in_time', null, array('class' => 'form-control timepicker' , 'required'=>'required')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Out-Time:</label>
				 	{!! Form::text('out_time', null, array('class' => 'form-control timepicker', 'required'=>'required')) !!}
				</div>
				<div class=" col-md-4 form-group">
			        <label>Select Department:</label>
			        <select name="department_id" class="form-control" required>
			        <option></option>
			            @foreach($departments as $department)
			                <option value="{{$department->id}}">{{ $department->name}}</option>
			            @endforeach
			        </select>
			    </div>
				<div class=" col-md-4 form-group">
					<label>Address:</label>
					{!! Form::textarea('address', null, array('class' => 'form-control', 'size' => '5x3' ,'required'=>'required')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Education:</label>
					{!! Form::textarea('education', null, array('class' => 'form-control', 'size' => '5x3')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Descrption:</label>
					{!! Form::textarea('description', null, array('class' => 'form-control', 'size' => '5x3')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Certificate:</label>
					{!! Form::textarea('certificate', null, array('class' => 'form-control', 'size' => '5x3')) !!}
				</div>
				<div class=" col-md-4 form-group">
					<label>Speciality:</label>
					{!! Form::textarea('speciality', null, array('class' => 'form-control', 'size' => '5x3')) !!}
				</div>
				<div class=" col-md-4 form-group">
			        <label>Working Day:</label>
			        <select name="working_day[]" class="form-control" multiple="" required="" >
			        <option>Sunday</option>
			        <option>Monday</option>
			        <option>Tuesday</option>
			        <option>Wednesday</option>
			        <option>Thursday</option>
			        <option>Friday</option>
			        <option>Saturday</option>   
			        </select>
			    </div>
			    
				
		      </div>
		    <div class="modal-footer">
		        
		          <button class="btn " type="reset">Reset</button>
		           <button class="btn btn-primary" type="submit">Save changes</button>
		    </div>
		    {{Form::close()}}
		  </div>
		</div>
		</div>
		</div>
</div>		@stop