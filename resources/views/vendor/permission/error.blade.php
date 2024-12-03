@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
				<li>Permission Error</li>
			</ol>
		</div><br><!--/.row-->
<div class="container">
<div class="row">
    <div class="col-sm-12 text-center">
        <small>{{ config('app.name') }}</small>
        <div class="alert alert-danger">
        <h2>{{ $exception->getMessage() }}</h2>
        </div>
        <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Return to Home</a>
    </div>
  </div>
</div>

@endsection