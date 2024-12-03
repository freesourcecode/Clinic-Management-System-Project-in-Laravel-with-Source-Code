<div class="modal fade" id="addAppointment"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width: 50%">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Appointment</h4>
      </div>
      {!! Form::open(array('route' => 'appointment.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
      <div class="modal-body">
      <div class="row">
      <div class="col-md-6 form-group">
	        <label>Patient:</label>
	        <select name="patient_id" class="form-control select2" style="width:100%" required>
	        <option></option>
	            @foreach($patients as $patient)
	                <option value="{{$patient->id}}">ID:{{$setting->patient_prefix}}{{$patient->id}} {{ $patient->first_name}} {{ $patient->last_name}}</option>
	            @endforeach
	        </select>
	    </div>
	     <div class=" col-md-6 form-group">
	        <label>Doctor:</label>
	        <select name="doctor_id" class="form-control" id="doctor_select">
	        <option></option>
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
			<input type="text" name="appointment_date" class="form-control datepicker1"  data-date-start-date="0d">
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
          <button class="btn " type="reset">Reset</button>
           <button class="btn btn-primary" type="submit">Save changes</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
</div>
 <script>
        $(document).ready( function() {
            $('#doctor_select').on('change', function() {
                var id = $('#doctor_select').val();
                //ajax
              $('#available_time').load({!! json_encode(url('/days/')) !!}+'/'+id);
            });
                
        
        });
</script>

