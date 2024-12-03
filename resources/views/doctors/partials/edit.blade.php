<!-- Edit Modal -->
<div class="modal fade" id="editDoctor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit {{$doctor->first_name}} {{$doctor->last_name}}</h4>
      </div>
     {!! Form::model($doctor, ['enctype'=>'multipart/form-data','method' => 'PATCH','route' => ['doctor.update', $doctor->id]]) !!}
      <div class="modal-body">
      <div class="row">
      
      	<div class="col-md-4 form-group">
      	<label>Select Doctor:</label>
      	<select name="employee_id" class="form-control" required>
      	<option value="{{$doctor->employee->id}}">{{$doctor->employee->first_name}} {{$doctor->employee->middle_name}} {{$doctor->employee->last_name}}</option>
      	@foreach($employees as $employee)      	
      	<option value="{{$employee->id}}">DR.{{$employee->first_name}} {{$employee->middle_name}} {{$employee->last_name}}</option>
      	@endforeach
      	</select>
      	</div>
		<div class=" col-md-4 form-group">
			<label>Doctor Fee:</label>
		 	{!! Form::input('number','fee' ,null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
		<div class="col-md-4 form-group">
			<label>OPD Charge:</label>
			{!! Form::input('number', 'opd_charge' ,null, array('class' => 'form-control', 'required'=>'required')) !!}
	    </div>
      <div class="form-group">
            <label for="with_tax">With Tax</label>
            <input type="checkbox" name="with_tax" id="with_tax" >
          </div>
		
      </div>
		
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
        <button class="btn " type="reset">Reset</button>
        <button class="btn btn-primary" type="submit">Save changes</button>
   
    {{Form::close()}}
    <a class="btn btn-danger pull-left" id="delete_doctor"><span class="glyphicon glyphicon-remove "></span>Delete</a>
      </div>
  </div>
</div>
</div>
</div>