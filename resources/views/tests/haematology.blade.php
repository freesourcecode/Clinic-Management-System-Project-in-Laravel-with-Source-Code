@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Haematology Test</li>
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
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">Haematology Test</div>
					<div class="panel-body">
						<table id="example" class="table" cellspacing="0" width="100%">
				    	<thead>
				        <tr>
				        <th>ID</th>
				        <th>Name</th>
				        <th>Test References</th>
					    </tr>
					</thead>
					<tbody>
				    @foreach($tests as $test)
					    <tr>
					    	<td>{{$test->id}}</td>
					    	<td>{{$test->name}}</td>
					    	<td>
					    	@if(count($test->test_references))
					    		@foreach($test->test_references as $test_reference) 
					    			{{$test_reference->name}}, 
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
					{!! Form::open(array( 'method'=>'POST')) !!}
						<div class="form-group">
						<label>Select Test:</label>
							<select name="test_id" class="select form-control" required="">
								<option></option>
								@foreach($tests as $test)
									<option value="{{$test->id}}">{{$test->name}}</option>
								@endforeach
							</select>
						</div>
			        	<div class="form-group">
			          		<label>Test Reference:</label>
				         	<select name="test_reference_ids[]" class="select2 form-control" multiple>
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
	</div>
</div>
<script type="text/javascript">

 $(document).on('click', '#delete_test_reference', function() 
    {
    	var test_id = $(this).data('id');
    	var test_reference_id = $(this).data('id2')
    	$('#delete_id').val(id);
    	$('#test_reference_delete').modal('show');
    });

    $('#test_reference_table').DataTable();
</script>
@endsection
