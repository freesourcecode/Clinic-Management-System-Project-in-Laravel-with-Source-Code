@extends('layouts.app')
@section('content')
<div class="col-md-12 main">
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Users</li>
	</ol>
</div><br>
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Manage Role<a class="btn btn-sm btn-primary pull-right" href="{{route('role.create')}}">Add Role <span class="glyphicon glyphicon-share-alt"></span></a></div>
				<div class="panel-body">
					<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($roles as $role)
					<tr>
						<td>{{$role->id}}</td>
						<td>{{$role->name}}</td>
						<td>{{$role->description}}</td>
						<td>
							<a href="{{route('role.edit', $role->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span></a>
						</td>
						<td>
							<form action="{{route('role.destroy', $role->id)}}" method="POST">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></sapn></button>
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
