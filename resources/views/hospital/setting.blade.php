@extends('layouts.app')
@section('content')
<div class="col-md-12 main">   
<div class="row">
	<ol class="breadcrumb">
		<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
		<li class="active">Hospital Setting</li>
	</ol>
</div><!--/.row-->
		
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{$hospital->name}} Setting</h1>
	</div>

</div><!--/.row-->
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">Hospital Settings</div>
			<div class="panel-body">
				<div class="col-md-12">
					{!! Form::model($hospital, ['method' => 'POST', 'route' => ['hospital.update', $hospital->id], 'files' => true]) !!}
						<div class="form-group">
							<label>Hospital Name:</label>
							 {!! Form::text('name', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
							<label>Hospital Slogan:</label>
							 {!! Form::text('slogan', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
						<label>Change Logo:</label>
						 {!! Form::file('logo', null, array('class' => 'form-control')) !!}
						 </div>
						 <div class="form-group">
							<label>Email Address:</label>
							 {!! Form::text('email', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
							<label>Website:</label>
							 {!! Form::text('website', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
							<label>Address:</label>
							{!! Form::textarea('address', null, array('class' => 'form-control' , 'size' => '7x3')) !!}
						</div>
						<div class="form-group">
							<label>Contact:</label>
							{!! Form::textarea('contact', null, array('class' => 'form-control', 'size' => '7x3')) !!}
						</div>
						<div class="form-group">
							<label>About Us:</label>
							{!! Form::textarea('description', null, array('class' => 'form-control', 'size' => '5x8')) !!}
						</div>
						<div class="form-group">
						<button class="btn btn-primary" type="submit">Save Changes</button>
						<button class="btn btn-primary" type="reset">Default</button>
						</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">Pan Settings</div>
			<div class="panel-body">
				<div class="col-md-12">
						<div class="form-group">
							<label>Pan Number:</label>
							{!! Form::text('pan_no', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
							<label>Registration Number:</label>
							{!! Form::text('registration_no', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
						<button class="btn btn-primary" type="submit">Save Changes</button>
						<button class="btn btn-primary" type="reset">Default</button>
						</div>
					
						
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">Tax Settings</div>
			<div class="panel-body">
				<div class="col-md-12">
						<div class="form-group">
							<label>Tax Name:</label>
							{!! Form::text('tax_type', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
							<label>Percent (%)</label>
							{!! Form::text('tax_percent', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
						<button class="btn btn-primary" type="submit">Save Changes</button>
						<button class="btn btn-primary" type="reset">Default</button>
						</div>
					
						
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">Prefix Setting</div>
			<div class="panel-body">
				<div class="col-md-12">
						<div class="form-group">
							<label>Invoice Prefix:</label>
							{!! Form::text('invoice_prefix', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
							<label>Patient ID Prefix:</label>
							{!! Form::text('patient_prefix', null, array('class' => 'form-control')) !!}
						</div>
						<div class="form-group">
							<label>Invoice  Message:</label>
							{!! Form::text('invoice_message', null, array('class' => 'form-control')) !!}
						</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Save Changes</button>
						<button class="btn btn-primary" type="reset">Default</button>
						</div>
					{{ Form::close()}}
				</div>
			</div>
		</div>
	</div>
	</div></div>
@endsection