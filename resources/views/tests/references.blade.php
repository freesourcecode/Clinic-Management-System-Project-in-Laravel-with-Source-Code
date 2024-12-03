@extends('layouts.app')
@section('content')
<div class="col-md-12 main">
	<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Hematology Test</li>
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
					<div class="panel-heading">Test References</div>
					<div class="panel-body">
						<table id="example" class="table" cellspacing="0" width="100%">
				    	<thead>
				        <tr>
				        <th>Test Name</th>
				        <th>Unit</th>
				        <th>Ref Range</th>
				        <th>Action</th>
					    </tr>
					</thead>
					<tbody>
				    @foreach($test_references as $test_reference)
					    <tr>
					    	<td>{{$test_reference->name}}
								@if ($test_reference->children->count())
									@foreach ($test_reference->children as $child)
										<div style="margin:20px;">{{ $child->name}}</div>
									@endforeach
							@endif
							</td>
					    	<td>
								@if ($test_reference->children->count())
									Unit
									@foreach ($test_reference->children as $child)
										<div style="margin:20px;">{{ $child->unit}}</div>
									@endforeach
								@else
									{{$test_reference->unit}}
								@endif
							</td>
					    	<td>
								@if ($test_reference->children->count())
								Range
									@foreach ($test_reference->children as $child)
										<div style="margin:20px;">{{ $child->range}}</div>
									@endforeach
								@else
									{{$test_reference->range}}
								@endif
							</td>
			           		<td>
	                           <button class="edit_test_reference btn-sm btn-info" data-info="{{$test_reference->id}},{{$test_reference->name}},{{$test_reference->unit}},{{$test_reference->range}}, {{$test_reference->parent_id}}">
								   <span class="glyphicon glyphicon-edit"></span>
							   </button>
							   <button class="btn-sm btn-danger" id="delete_test_reference"  data-id="{{$test_reference->id}}">
								   <span class="glyphicon glyphicon-remove "></span>
							   </button>
								@if ($test_reference->children->count())
									@foreach ($test_reference->children as $child)
									<br><button style="margin-top:5px;" class="edit_test_reference btn-sm btn-info" data-info="{{$child->id}},{{$child->name}},{{$child->unit}},{{$child->range}}, {{$child->parent_id}} ">
	 								   <span class="glyphicon glyphicon-edit"></span>
	 							   </button>
								   @permission('reference.delete')
	 							   <button class="btn-sm btn-danger" id="delete_test_reference"  data-id="{{$child->id}}">
	 								   <span class="glyphicon glyphicon-remove "></span>
	 							   </button>
								   @endpermission
									@endforeach
								@endif
							</td>
				        </tr>
				    @endforeach
				    </tbody>
					</table>
				</div>
			</div>
		</div>
	<div class="col-md-4" id="add_test_reference">
		<div class="panel panel-default">
			<div class="panel-heading">Add Test References</div>
				<div class="panel-body">
					{!! Form::open(array('route' => 'reference.store','method'=>'POST')) !!}

				      	<div class="form-group">
						    <label>Name:</label>
					 	    {!! Form::text('name', null, array('class' => 'form-control test_name', 'required'=>'required')) !!}
					    </div>
			    		<div class="form-group">
			    			<label>Unit:</label>
			    			{!! Form::text('unit', null, array('class' => 'form-control')) !!}
			    		</div>
			    		<div class="form-group">
			    			<label>Ref Range:</label>
			    			{!! Form::text('range', null, array('class' => 'form-control')) !!}
			    		</div>
			        	<div class="form-group">
			          		<label>Parent Test:</label>
				         	<select name="parent_id" class="form-control">
				            	<option></option>
				            	@foreach ( $test_references as $test_reference)
					            <option value="{{$test_reference->id}}">{{$test_reference->name}}</option>
					            @endforeach
					        </select>
				        </div>
				        <button class="btn-sm btn-primary">Add</button>
				        <input type="reset" value="Reset" class="btn-sm btn-default">
				    {{Form::close()}}
				</div>
			</div>
		</div>

<div class="col-md-4" style="display: none" id="edit_test_reference">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Test References</div>
				<div class="panel-body">
					{!! Form::open(array('route' => 'reference.update','method'=>'POST')) !!}
						<input type="hidden" name="id" id="id">
				      	<div class="form-group">
						    <label>Name:</label>
					 	    {!! Form::text('name', null, array('class' => 'form-control', 'required'=>'required', 'id' =>'name')) !!}
					    </div>
			    		<div class="form-group">
			    			<label>Unit:</label>
			    			{!! Form::text('unit', null, array('class' => 'form-control', 'id' => 'unit')) !!}
			    		</div>
			    		<div class="form-group">
			    			<label>Ref Range:</label>
			    			{!! Form::text('range', null, array('class' => 'form-control' ,'id'=>'range')) !!}
			    		</div>
			        	<div class="form-group">
			          		<label>Parent Test:</label>
				         <select name="parent_id" class="form-control" id='parent_select'>
				         	<option></option>
				         
			            	@foreach ( $test_references as $test_reference)
				            <option value="{{$test_reference->id}}">{{$test_reference->name}}</option>
				            @endforeach
				        </select>
				        </div>
				        <button class="btn-sm btn-primary">Edit</button>
				        <input type="reset" value="Cancel" class="btn-sm btn-default" id="cancel">
				    {{Form::close()}}
				</div>
			</div>
		</div>
		</div>
		</div>
	
<div class="modal fade" id="test_reference_delete"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Delete test_reference</h4>
      </div>
      {!! Form::open(array('route' => 'reference.delete','method'=>'POST')) !!}
      <div class="modal-body">
      <input type="hidden" name="id" id="delete_id">
      	<label>Are your sure want to delete this test reference?</label>
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
 $(document).on('click', '.edit_test_reference', function() {

        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#edit_test_reference').show();
        $('#add_test_reference').hide();
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#unit').val(details[2]);
        $('#range').val(details[3]);
        $('#parent_select').val(details[4]);

    }
     $(document).on('click', '.edit-test_reference', function() {

        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodal(stuff)
        $('#edittest_reference').modal('show');
    });
     function fillmodal(details)
    {
        $('#id_test_reference').val(details[0]);
        $('#test_reference_name').val(details[1]);
    }
     $(document).on('click', '#delete_test_reference', function()
    {
    	var id = $(this).data('id');
    	$('#delete_id').val(id);
    	$('#test_reference_delete').modal('show');
    });

     $('#test_reference_table').DataTable();

</script>
@endsection
