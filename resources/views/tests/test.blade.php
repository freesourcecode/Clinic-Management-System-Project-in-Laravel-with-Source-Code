@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Manage Test</li>
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
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">Manage Test</div>
					<div class="panel-body">
					
					<table id="example" class="table" cellspacing="0" width="100%">
				    	<thead>
				        <tr>
			            	<th>ID</th>
					        <th>Name</th>
					        <th>Type</th>
					        <td>Description</td>
					        <th>Action</th>
						    </tr>
						</thead>
						    <tbody>
						     @foreach($tests as $test)
						    	<tr>
							    	<td>{{$test->id}}</td>
							    	<td>{{$test->name}}</td>
							    	<td>{{ucfirst($test->report_type)}}</td>
							    	<td>{{$test->description}}</td>
					           		<td>
			                           	<button id="test_edit" class="btn-sm btn-info" data-info="{{$test->id}}, {{$test->name}},{{$test->report_type}}, {{$test->description}}">
			                           		<span class="glyphicon glyphicon-edit" ></span>
			                            </button>
			                            <button class="btn-sm btn-danger" data-test="{{$test->id}}" id="test_delete">	<span class="glyphicon glyphicon-remove"></span>
			                            </button>
	                            	</td>
				        		</tr>
				    		@endforeach
				    </tbody>
					</table>
					
					</div>
				</div>
			</div>
			<div class="col-md-3 add">
			<div class="panel panel-default">
				<div class="panel-heading">Add New Test</div>
				<div class="panel-body">
				{!! Form::open(array('route' => 'test.store','method'=>'POST')) !!}
				<div class="form-group">
		      	<label>Select Services:</label>
			        <select name="service_id" class="form-control select" required="" style="width:100%" id="service">
			        <option></option>
			            @foreach($services as $service)
			                <option value="{{$service->id}}" data-name="{{$service->name}}">{{ $service->name}}</option>
			            @endforeach
			        </select>
			    </div>
			    <div class=" form-group">
					<label>Test Name:</label>
				 	{!! Form::text('name', null, array('class' => 'form-control', 'id' => 'test_name')) !!}
				</div>
				<div class="form-group">
				<label>Report Type:</label>
					<select class="form-control" name="report_type" required="">
					<option></option>
						<option value="haematology">HAEMATOLOGY</option>
						<option value="biochemistry">BIOCHEMISTRY</option>
						<option value="immunology">IMMUNOLOGY</option>
						<option value="examination">EXAMINATION</option>
						<option value="microbiology">MICROBIOLOGY</option>
						<option value="stain">STAIN</option>
						<<option value="widal">WIDAL</option>}
						option
					</select>
				</div>
				<div class="form-group">
					<label>Description:</label>
				 	{!! Form::text('description', null, array('class' => 'form-control')) !!}
				</div>
			    </div>
			    <div class="panel-footer">
				<button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-edit'></span>Add</button>
				<button class="btn btn-default pull-right" type="reset">Reset</button>
           		</div>
           		{!! Form::close()!!}
			</div>
		</div>
		<!-- Edit Test -->
		<div class="col-md-3 edit" style="display: none">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Test</div>
				<div class="panel-body">
				{!! Form::open(array('route' => 'test.edit','method'=>'POST' )) !!}
				<input name="id" type="name" class="hidden form-control" id="id" >
			    <div class=" form-group">
					<label>Test Name:</label>
				 	{!! Form::text('name', null, array('class' => ' form-control', 'required'=>'required', 'id'=>'name')) !!}
				</div>
				<div class="form-group">
				<label>Report Type:</label>
					<select class="form-control" name="report_type" id="report_type">
						<option value="haematology">HAEMATOLOGY</option>
						<option value="biochemistry">BIOCHEMISTRY</option>
						<option value="immunology">IMMUNOLOGY</option>
						<option value="examination">EXAMINATION</option>
						<option value="microbiology">MICROBIOLOGY</option>
						<option value="stain">STAIN</option>
						<<option value="widal">WIDAL</option>}
						option
						
					</select>
				</div>
				<div class="form-group">
					<label>Description:</label>
				 	{!! Form::text('description', null, array('class' => 'form-control', 'id'=>'description')) !!}
				</div>
				
				<div class="panel-footer">
					<button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-edit'></span>Edit</button>
					<a class="btn btn-default pull-right" id="cancel">Cancel</a>
           		</div>
           		{!! Form::close()!!}
			</div>
		</div>
</div>

</div><!--/.row-->	
<div class="modal fade" id="deletetest"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Delete Test</h4>
      </div>
      {!! Form::open(array('route' => 'test.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="test_id">
      	<label>Are your sure want to Delete this test?</label>
      </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> No</button>
           <button class="btn btn-danger" type="submit"><span class='glyphicon glyphicon-ok'></span> Yes</button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
<script type="text/javascript">
$('#service').on('change', function() {
	
	var test_name = $("#service option:selected").text();
	$('#test_name').val(test_name);
});

$('#cancel').click(function(){
	 	$('.edit').hide();
        $('.add').show();
});
  
 $(document).on('click', '#test_edit', function() {
 		
        var stuff = $(this).data('info').split(',');
        $('.add').hide();
 		$('.edit').show();
 		fillmodalData(stuff)
        
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#report_type').val(details[2]);
       	$('#description').val(details[3]);
        
    }

    $(document).on('click', '#test_delete', function() 
    {
    	var id = $(this).data('test');
    	$('#test_id').val(id);
    	$('#deletetest').modal('show');
    });
</script>
@endsection
