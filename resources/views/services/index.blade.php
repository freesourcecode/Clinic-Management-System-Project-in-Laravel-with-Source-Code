@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>'
				<li>Services</li>
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
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">Service Table<a class="btn btn-sm btn-primary pull-right" href="{{url('/')}}">Back <span class="glyphicon glyphicon-share-alt"></span></a></div>
					<div class="panel-body">
						<table id="example" class="table" cellspacing="0" width="100%">
						<thead>
				        <tr>
				            <th >ID</th>
				            <th >Service</th>
				            <th >Department</th>
				            <th>Amount</th>
				            <th >Actions</th>
				            
				        </tr>
				    	</thead>
				    	<tbody>
				    	@foreach($services as $service)
				        <tr class="sevice{{$service->id}}">
				            <td>{{ $service->id}}</td>
				            <td>{{ $service->name}}</td>
				            <td>{{ $service->department->name}}</td>
				            <td>{{ number_format($service->amount, 2)}}</td>
				           <td>
                           <button style="margin-right: 5px" class="btn-sm btn-info edit_service" data-info="{{$service->id}},{{$service->name}},{{$service->amount}},{{$service->department_id}}"><span class="glyphicon glyphicon-edit"></span>
                            </button>
                            <button class="btn-sm btn-danger" id="delete_service"  data-id="{{$service->id}}"><span class="glyphicon glyphicon-remove "></span></button>
                            </td>
				        </tr>
				    	@endforeach
				    	</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4 add">
			<div class="panel panel-default">
				<div class="panel-heading">Add Service</div>
				<div class="panel-body">
				 {!! Form::open(array('route' => 'service.add','method'=>'POST')) !!}
				 <div class="form-group">
			<label>Service Name:</label>
		 	{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
		<div class="form-group">
			<label>Service Amount:</label>
		 	{!! Form::text('amount' ,null, array('class' => 'form-control', 'required'=>'required')) !!}
		</div>
		<div class="form-group">
	        <label>Department:</label>
	        <select name="department_id" class="form-control" required>
	        <option></option>
	            @foreach($departments as $department)
	                <option value="{{$department->id}}">{{ $department->name}}</option>
	            @endforeach
	        </select>
	    </div>
	    <div class="form-group">
	    	<label for="with_tax">With Tax</label>
	    	<input type="checkbox" name="with_tax" id="with_tax" checked="">
	    </div>

		</div>
		<div class="panel-footer">
		
   		<button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-plus'></span>Add</button>
   		<button class="btn pull-right" type="reset">Reset</button>
   		</div>
   		{!! Form::close()!!}
   		</div>
				
		</div>

		<div class="col-md-4 edit" style="display: none">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Service</div>
			<div class="panel-body">
			{!! Form::open(array('route' => 'service.edit','method'=>'POST' )) !!}
			<input name="id" type="name" class="hidden form-control" id="id" >
			<div class="form-group">
				<label>Service Name:</label>
		 		{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required', 'id'=>'name')) !!}
			</div>
			<div class="form-group">
				<label>Service Amount:</label>
				<input type="text" name="amount" id="amount" required class="form-control">
			</div>
			<div class="form-group">
		        <label>Department:</label>
		        <select name="department_id" class="form-control" id="department_id">
		        <option id="department_id" value=""></option>
		            @foreach($departments as $department)
		                <option value="{{$department->id}}">{{ $department->name}}</option>
		            @endforeach
		        </select>
		    </div>

		    <div class="form-group">
		    	<label for="with_tax">With Tax</label>
		    	<input type="checkbox" name="with_tax" id="with_tax" checked="">
	    	</div>
			</div>
				<div class="panel-footer">
				<a class="btn btn-default pull-right" id="cancel" >Cancel</a>
           		<button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-edit'></span>Edit</button>
           		</div>
           		{!! Form::close()!!}
        </div>
				
		</div>

		</div><!--/.row-->	
</div><!--/.main-->
<div class="modal fade" id="user_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Delete Service</h4>
      </div>
      {!! Form::open(array('route' => 'service.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="delete_id">
      	<label>Are your sure want to delete this service?</label>
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
$('#cancel').click(function(){
	 	$('.edit').hide();
        $('.add').show();
})
	$(document).on('click', '.edit_service', function() {
        
        $('.add').hide();
        $('.edit').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);

        var amount = details[2];
        var tax = {{$setting->tax_percent/100}};
        var tax_amount = amount * tax;
        var total = parseFloat(amount) + parseFloat(tax_amount);
        total = total.toFixed();
        $('#amount').val(total);
        $('#department_id').val(details[3]);
    }

    $(document).on('click', '#delete_service', function() 
    {
    	var id = $(this).data('id');
    	$('#delete_id').val(id);
    	$('#user_delete').modal('show');
    });
     $(document).ready(function() {
    $('#dataPrint').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy',
          'csv',
          'print' 
        ]
    } );
} );

</script>
@endsection