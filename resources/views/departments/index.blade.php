@extends('layouts.app')
@section('content')

<div class="col-md-12 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Department</li>

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
				<div class="panel-heading">Department Table <a class="btn btn-sm btn-primary pull-right" href="{{url('/')}}">Back <span class="glyphicon glyphicon-share-alt"></span></a></div>
				<div class="panel-body">
				@if($departments->count())
					<table id="example" class="table" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th>ID</th>
				            <th>Department</th>
				            <th>Actions</th>
				        </tr>
				    </thead>
				    <tbody>
				    @foreach($departments as $department)
				        <tr>
				            <td>{{ $department->id}}</td>
				            <td>{{ $department->name}}</td>
				           <td>
                           <button style="margin-right: 5px" class="btn-sm btn-info" data-info="{{$department->id}},{{$department->name}}" id="edit_department"><span class="glyphicon glyphicon-edit"></span>
                            </button>@permission('department.delete')
                           <button class="btn-sm btn-danger" id="delete_department"  data-id="{{$department->id}}"><span class="glyphicon glyphicon-remove "></span></button>@endpermission
                           </td>
				        </tr>
				    @endforeach
				    </tbody>
					</table>
				@else
				<h3 align="center">No department Found</h3>
				@endif
				</div>
			</div>
		</div>
		<div class="col-md-4 add">
		<div class="panel panel-default">
				<div class="panel-heading">Add Department</div>
				<div class="panel-body">
				{!! Form::open(array('route' => 'department.add','method'=>'POST')) !!}
				 <div class="form-group">
					<label>Department Name:</label>
				 	{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required')) !!}
				</div>
				</div>
				<div class="panel-footer">
	           		<button class="btn btn-primary" type="submit">
	           		<span class='glyphicon glyphicon-plus'></span>Add</button>
	           		<button class="btn pull-right" type="reset">Reset</button>
           		</div>
           		{!! Form::close()!!}
           		</div>
				
		</div>
		<div class="col-md-4 edit" style="display: none">
		<div class="panel panel-default">
				<div class="panel-heading">Edit Department</div>
				<div class="panel-body">
				{!! Form::open(array('route' => 'department.edit','method'=>'POST')) !!}
				<input name="id" type="hidden" id="id" >
				<div class="form-group">
					<label for="name">Department Name:</label>
				 	{!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required', 'id'=>'name')) !!}
				</div>
				</div>
				<div class="panel-footer">
				<button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-edit'></span>Edit</button>
				<a class="btn btn-default pull-right" id="cancel">Cancel</a>
           		
           		</div>
           		{!! Form::close()!!}
        </div>
				
		</div>
	</div><!--/.row-->		
</div>
<div class="modal fade" id="user_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Delete Department</h4>
      </div>
      {!! Form::open(array('route' => 'department.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="delete_id">
      	<label>Are your sure want to delete this department?</label>
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
});
	$(document).on('click', '#edit_department', function() {
        
        $('.add').hide();
        $('.edit').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
    }

    $(document).on('click', '#delete_department', function() 
    {
    	var id = $(this).data('id');
    	$('#delete_id').val(id);
    	$('#user_delete').modal('show');
    });

</script>
@endsection