
<div class="modal fade" id="addAppointment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Appointment</h4>
      </div>
      {!! Form::open(array('route' => 'appointment.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
	    <div class="modal-body">
	    <div class="row">
	    <div class=" col-md-6 form-group">
	     <label>Patient:</label>
	    <input type="text" value="{{$patient->first_name}}" class="form-control" disabled="">
	    <input type="hidden" name="patient_id" value="{{$patient->id}}">
	    </div>
	     <div class=" col-md-6 form-group">
	        <label>Doctor:</label>
	        <select name="doctor_id" class="form-control" required id="doctorId">
	        <option>Select Doctors</option>
	            @foreach($doctors as $doctor)
	                <option value="{{$doctor->id}}">{{ $doctor->employee->first_name}} {{ $doctor->employee->last_name}}</option>
	            @endforeach
	        </select>
	    </div>
	    <div class=" col-md-6 form-group">
			<label>Available Time:</label>
			<div id="available_time">
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
		<label>Appointment Date:</label>
			<input type="text" name="appointment_date" id="datepicker" class="form-control">
		</div>
		</div>
      	<div class=" col-md-6 form-group">
			<label>Name:</label>
		 	{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
		
		<div class=" col-md-6 form-group">
			<label>Description:</label>
		 	{!! Form::text('description', null, array('class' => 'form-control')) !!}
		</div>
		
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          <button class="btn " type="reset">Reset</button>
           <button class="btn btn-primary" type="submit">Save changes</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
</div>

<!-- Edit Appointment modal -->
