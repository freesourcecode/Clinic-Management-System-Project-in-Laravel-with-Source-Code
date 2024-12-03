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
@endif
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Add Role<a class="btn btn-sm btn-primary pull-right" href="{{url('/')}}">Back <span class="glyphicon glyphicon-share-alt"></span></a></div>
			<div class="panel-body">
            <form action="{{ route('role.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-3 form-group">
                    <label>Role Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="">
                    <label>Description</label>
                    <input class="form-control" name="description" required="" value="{{ old('description') }}">
                </div>
                <div class="col-md-9 form-group">
                    <label>Permission</label>
                    <div class="row">
                    @foreach($permissions as $object => $controller)
                        <div class="col-md-2">
                            <strong>{{ ucfirst($object) }}</strong>
                            @foreach($controller as $permission)
                            <div class="checkboxes in-row ">
                                <input id="{{$permission->id}}" type="checkbox" value="{{ $permission->id }}" name="permission_ids[]" {{ !in_array($permission->id, old('permission_ids', [])) ?: 'checked="true"' }}><label for="{{$permission->id}}">{{ $permission->action }}</label>
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
                    <button class="btn-sm btn btn-primary" type="submit">Save</button>

                </div>

            </div>

        </div>

    </div>

</form>


@stop
