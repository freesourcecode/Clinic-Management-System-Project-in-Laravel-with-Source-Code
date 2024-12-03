@extends('layouts.app')
@section('content')
<div class="col-md-12 main">
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Users</li>
	</ol>
</div><br>

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
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Role<a class="btn btn-sm btn-primary pull-right" href="{{url('/')}}">Back <span class="glyphicon glyphicon-share-alt"></span></a></div>
			<div class="panel-body">
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PATCH">
					<div class="row">
                        <div class="col-md-3 form-group">
                            <label>Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" required="">
                            <label>Description</label>
                             <textarea class="form-control" id="description" name="description">{{ old('description', $role->description) }}</textarea>
                        </div>

                        <div class="col-md-9 form-group">
                            <h4><u>Permissions</u></h4>
                            <div class="row">
                            @foreach($permissions as $object => $controller)
                                <div class="col-md-2">
                                    <strong>{{ ucfirst($object) }}</strong>
                                    @foreach($controller as $permission)
                                    <div class="checkboxes in-row ">
                                        <input id="{{$permission->id}}" type="checkbox" value="{{ $permission->id }}" name="permission_ids[]" {{ !in_array($permission->id, old('permission_ids', $selected_permission_ids)) ?: 'checked="true"' }}><label for="{{$permission->id}}">{{ $permission->action }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            @endforeach
                            </div>
                        </div>
					</div>
                        <button class="btn btn-primary" type="submit">Edit</button>
                    </div>

                </form>
            </div>
            </div>
        </div>

</div>
</div>
</div>
</div>



@stop
