@extends('layouts.app')
@section('content')
<div class="col-md-12 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Patient Report</li>
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
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Lab Report Generate </div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6 form group">
								<strong>Patient Name: {{$report->patient->first_name}} {{$report->patient->middle_name}} {{$report->patient->last_name}}</strong><br>
								<strong>Patient ID#:{{$setting->patient_prefix}}{{$report->patient_id}}</strong>
								<br><strong>Age:{{$report->patient->age}}</strong><br>
								<strong>Sex:{{$report->patient->gender}}</strong>
							</div>
							<div class="col-md-3 form group pull-right">
								<strong>Report ID#: {{$report->id}}</strong><br>
								<strong>Register Date: {{$report->created_at}}</strong><br>
								@if($report->doctor_id)
								<strong>Referred By: {{$report->doctor_name}}</strong><br>
								@endif
							</div><br>
							<div class="col-md-12 form-group">
							<h2 align="center">Lab Report</h2><br>
							</div>
						</div>
						<div class="row">
						@if($test_reports->count())
							<div class="col-md-6">
							<label>Select Tests:</label>
								<select class="form-control" name="test" id="test_report">
								<option>Select Test:</option>
								@foreach($test_reports as $test_report)
								<option value="{{$test_report->id}}">{{$test_report->test->name}}</option>
								@endforeach
								</select>
							</div>
						@endif
						<!-- Results count -->
						@if($results->count()) 
						<!-- forloop 1results -->
							<div class="col-md-6">
							<label>Select Result:</label>
								<select class="form-control" name="test_id" id="test_result">
								<option>Select Result:</option>
								@foreach($results as $result)
								<option value="{{$result->id}}">{{$result->test->name}}</option>
								@endforeach
								</select>
							</div>
							<div class="col-md-12">
							<a class="btn btn-primary pull-right" href="{{url('/report/print', $report->id)}}"><span class="glyphicon glyphicon-print"> </span> Print</a>
						</div>
						@endif
						</div>
					</div>
				</div>
			</div>
		</div>



			
<div class="modal fade" id="addResult"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:50%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Test Result</h4>
			</div>
				{!! Form::open(array('route' => 'result.store','method'=>'POST')) !!}
				<div class="modal-body">
					<div class="form-group">
						<div class="test_result"></div>
					</div>
				</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> Close</button>
				<button class="btn " type="reset">Reset</button>
				<button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-ok'></span> Save changes</button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="editResult"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:50%">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Test Result</h4>
		</div>
		{!! Form::open(array('route' => 'result.edit','method'=>'POST')) !!}
			<div class="modal-body">
				<div class="form-group">

					<div class="test_result"></div>
				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-default" type="button"><span class='glyphicon glyphicon-remove'></span> Close</button>
					<button class="btn " type="reset">Reset</button>
					<button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-ok'></span> Save changes</button>
					</div>
			{{Form::close()}}
			</div>
		</div>
	</div>
</div>


</div>

	
<script type="text/javascript">

	$(document).on("click", ".test_result .add-more", function(e) {
           
			e.preventDefault();
			var newLoc = $('.widal-table .widal-tr').first().clone();
			newLoc.appendTo('table.widal-table');
		});

	$(document).on("click", ".widal-table .delete", function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().remove();
        });

  
 $(document).on('change', '#test_report', function() {

        var id = $('#test_report').val();
       $('.test_result').load({!! json_encode(url('/result/test'))!!}+'/'+id);
       $('#addResult').modal('show');
       
    });

  $(document).on('change', '#test_result', function() {

        var id = $('#test_result').val();
       
       $('.test_result').load({!! json_encode(url('/result/tests'))!!}+'/'+id);
       $('#editResult').modal('show');
       
    });

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#value').val(details[2]);
        $('#flag').val(details[3]);
    }

     
</script>
@endsection
