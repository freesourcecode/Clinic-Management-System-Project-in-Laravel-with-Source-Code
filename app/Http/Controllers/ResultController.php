<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Result;
use App\Models\Test;
use App\Models\Sample;
use App\Models\TestReport;
use App\Models\TestResult;
use App\Models\TestReferenceResult;
use App\Models\ExaminationResult;
use App\Models\Doctor;
use App\Models\TestAntibioticResult;
use App\Models\TestAntibiotic;


class ResultController extends Controller
{
	public function index()
	{
		$reports = Report::where('status', 0)->get();
		return view('results.index', compact('reports'));
	}
	
	public function generateReport($report_id)
	{
		//return $report_id;
		$report = Report::find($report_id);
		if($report->doctor_id)
		{
			$doctor = Doctor::find($report->doctor_id);
			$report['doctor_name'] = $doctor->employee->first_name. ' '. $doctor->employee->last_name;
		}
		//return $report;
		$test_reports = $report->test_reports()->where('status', 0)->where('sample', 1)->get();
		$results = $report->test_reports()->where('status', 1)->get();
		//return $results->test_results()->get();
		return view('results.index', compact('report', 'test_reports' ,'results'));
	}

	public function getTest($id)
	{

		$test_report = TestReport::find($id);

		$test = $test_report->test;
		$list ='';
		
		$list .='<input type="hidden" name="test_report_id" value="'.$id.'">';

		if ($test_report->report_type == 'haematology' || $test->report_type == 'biochemistry') {

			$list .= $this->getReferenceResult($test);// $list .= $this->test_reference($test);
	
		}

		if ($test_report->report_type == 'immunology') {

			$list .= $this->getImmunologyResult($test);

		}
		if ($test_report->report_type == 'stain') {

			$list .= $this->getStainResult($test);

		}
		
		if ($test_report->report_type == 'examination') {

			$list .= $this->getExaminationResult($test);
		}

		if ($test_report->report_type == 'microbiology') {

			$list .= $this->getMicrobiologyResult($test);
		}

		if ($test_report->report_type == 'widal') {

			$list .= $this->getWidalResult($test);
		}
		
		return $list;
	}


	public function getTests($id)
	{
		$test_report = TestReport::find($id);
		$test = $test_report->test;
		$list ='';
		$list .='<input type="hidden" name="test_report_id" value="'.$id.'">';

		if ($test->report_type == 'haematology' || $test->report_type == 'biochemistry') {

			$list .= $this->editReferences($test, $test_report);
		}

		if ($test->report_type == 'immunology')	{

			$list .= $this->editImmunology($test, $test_report);
		}

		if ($test->report_type == 'stain') {

			$list .= $this->editStain($test, $test_report);
		}

		if ($test->report_type == 'examination') {

			$list .= $this->editExamination($test, $test_report);
		}
		

		if ($test->report_type == 'microbiology') {

			$list .= $this->editMicrobiology($test, $test_report);

		}

		if ($test->report_type == 'widal') {

			$list .= $this->editWidal($test, $test_report);
		}
		return $list;
	}


	public function store(Request $request)
	{
		//return $request->all();
		$test_report = TestReport::find($request->test_report_id);
		$test = $test_report->test;

		if ($test->report_type == 'haematology' || $test->report_type == 'biochemistry') {

			if(count($test->test_references)) {

				$len = count($request->test_reference_id);

				for($i = 0; $i < $len; $i++) {

					$result_value['test_report_id'] = $test_report->id;
					$result_value['test_reference_id'] = $request->test_reference_id[$i];
					$result_value['result'] = $request->result[$i];
					$result_value['flag'] = $request->flag[$i];
					$result = TestReferenceResult::create($result_value);

					$test_result['status'] = 1;
					$test_result['test_report_id'] = $test_report->id;
					$test_result['result'] = $request->test_result;
					TestResult::create($test_result);
				}

			} else {

				$test_result['status'] = 1;
				$test_result['test_report_id'] = $test_report->id;
				$test_result['result'] = $request->result;
				TestResult::create($test_result);
			}

			$data['status'] = 1;
			$test_report->update($data);
		}	

		if ($test->report_type == 'immunology') {

			if (count($test->test_references)) {

				$len = count($request->test_reference_id);
				for($i = 0; $i < $len; $i++) {

					$result_value['test_report_id'] = $test_report->id;
					$result_value['test_reference_id'] = $request->test_reference_id[$i];
					$result_value['result'] = $request->result[$i];
					$result_value['flag'] = $request->flag[$i];
					$result = TestReferenceResult::create($result_value);

					$test_result['status'] = 1;
					$test_result['test_report_id'] = $test_report->id;
					$test_result['result'] = $request->test_result;
					TestResult::create($test_result);
					$data['status'] = 1;
					$test_report->update($data);
				}

			} else {

				$test_result['status'] = 1;
				$test_result['test_report_id'] = $test_report->id;
				$test_result['result'] = $request->result;
				TestResult::create($test_result);
				$data['status'] = 1;
				$test_report->update($data);
			}
			
		}

		if ($test->report_type == 'stain') {

			$test_result['result'] = serialize($request->result);
			$test_result['test_report_id'] = $test_report->id;
			$test_result['status'] = 1;
			TestResult::create($test_result);
			$data['status'] = 1;
			$test_report->update($data);
		}

		if ($test->report_type == 'examination') {

			$test_result['macroscopic_result'] = serialize($request->macroscopic_result);
			$test_result['microscopic_result'] = serialize($request->microscopic_result);
			$test_result['test_report_id'] = $test_report->id;
			$result = [ 'macroscopic_comment' => $request->macroscopic_comment,
						'microscopic_comment' => $request->microscopic_comment];
			$test_result['result'] =  serialize($result);
			ExaminationResult::create($test_result);
			$data['status'] = 1;
			$test_report->update($data);
			$test_results['test_report_id'] = $test_report->id;
			$test_results['result'] = $request->test_result;
			$test_results['status'] = 1;
			TestResult::create($test_results);
			$test_reports['status'] = 1;
			$test_report->update($test_reports);
		}

		if ($test->report_type == 'microbiology') {
			//return $request->all();

			$len = count($request->test_antibiotic_ids);

			for ($i=0; $i < $len; $i++)
			{ 
				$result_value['test_report_id'] = $test_report->id;
				$result_value['test_antibiotic_id'] = $request->test_antibiotic_ids[$i];
				$result_value['result'] = $request->antibiotic_result[$i];
				$result = TestAntibioticResult::create($result_value);

			}

			$data['result'] = $request->test_result;
			$data['status'] = 1;
			$data['test_report_id'] = $test_report->id;
			TestResult::create($data);

			$test_reports['status'] = 1;
			$test_report->update($test_reports);
		}

		if($test->report_type == 'widal') {
	
			$result['antigens'] = $request->antigens;
			$result['results'] = $request->results;
			$result['agglutinations'] = $request->agglutinations;
			$result['significants'] = $request->significants;
			$data['result'] = serialize($result);
			$data['status'] = 1;
			$data['test_report_id'] = $test_report->id;
			TestResult::create($data);

			$test_reports['status'] = 1;
			$test_report->update($test_reports);

		}

		return back()->with('success', 'Test Result saved successfully');
	}

	public function edit(Request $request)
	{
		///return $request->all();
		$test_report = TestReport::find($request->test_report_id);
		$test = $test_report->test;
		//return $test;
		if ($test->report_type == 'haematology' || $test->report_type == 'biochemistry') {

			if(count($test->test_references)) {

				$len = count($request->test_reference_result_id);
				//return $len;

					for($i = 0; $i < $len; $i++) {

						$test_reference_result = TestReferenceResult::find($request->test_reference_result_id[$i]);
						$data['result'] = $request->result[$i];
						$data['flag'] = $request->flag[$i];
						$test_reference_result->update($data);

						$test_results['result'] = $request->test_result;
						$test_report->test_result->update($test_results);
					}
				} else {

						$test_results['result'] = $request->result;
						$test_report->test_result->update($test_results);
					}
				
				$data['status'] = 1;
				$test_report->update($data);	
		}

		if ($test->report_type == 'immunology') {

			if(count($test->test_references)) {

				$len = count($request->test_reference_result_id);
				//return $len;
					for($i = 0; $i < $len; $i++) {

						$test_reference_result = TestReferenceResult::find($request->test_reference_result_id[$i]);
						$data['result'] = $request->result[$i];
						$data['flag'] = $request->flag[$i];
						$test_reference_result->update($data);
					}

					$test_result['test_report_id'] = $test_report->id;
					$test_result['result'] = $request->test_result;
					$test_report->test_result->update($test_result);
				} else {

						$test_result['test_report_id'] = $test_report->id;
						$test_result['result'] = $request->result;
						$test_report->test_result->update($test_result);
				}

				
			}
			

		if ($test->report_type == 'stain') {

			$test_result['result'] = serialize($request->result);
			$test_result['test_report_id'] = $test_report->id;
			$test_result['status'] = 1;
			$test_report->test_result->update($test_result);
		}

		if ($test->report_type == 'examination') {

			$test_result['macroscopic_result'] = serialize($request->macroscopic_result);
			$test_result['microscopic_result'] = serialize($request->microscopic_result);
			$test_result['test_report_id'] = $test_report->id;
			$result = [ 'macroscopic_comment' => $request->macroscopic_comment,
						'microscopic_comment' => $request->microscopic_comment];
			$test_result['result'] =  serialize($result);
			$test_report->examination_result->update($test_result);
			$test_results['result'] = $request->test_result;
			$test_report->test_result->update($test_results);
			$data['status'] = 1;
			$test_report->update($data);	
		}

		if ($test->report_type == 'microbiology') {

			$count = count($request->test_antibiotic_ids);
					for ($i=0; $i < $count; $i++)
				{ 
					$test_antibiotic_result = TestAntibioticResult::find($request->test_antibiotic_ids[$i]);
					$result_value['result'] = $request->antibiotic_result[$i];
					
					$test_antibiotic_result->update($result_value);
				} 

				$test_results['result'] = $request->test_result;
				$test_report->test_result->update($test_results);
				$data['status'] = 1;
				$test_report->update($data);	
			}

			if ($test->report_type == 'widal') {

				$test_result = $test_report->test_result;

				$result['antigens'] = $request->antigens;
				$result['results'] = $request->results;
				$result['agglutinations'] = $request->agglutinations;
				$result['significants'] = $request->significants;
				$data['result'] = serialize($result);
				$test_result->update($data);
			}

			$test_report->update(['report_type' => $test_report->test->report_type]);
		
		return back()->with('success', 'Test Result saved successfully');
	}


	public function getReferenceResult($test)
	{

		$list = '';

		if(count($test->test_references)) {
		$list .='<table class="table"><tr><th>Name</th><th align="center">Result</th><th>Unit</th><th>Range</th><th>Flag</th></tr>';
		} else {

			$list .='<table class="table"><tr><th>Name</th><th colspan=4>Result</th></tr>';
		}

			if(count($test->test_references) > 1) {

				$list .= '<tr><td colspan="5"><strong>'.$test->name.'</strong><td></tr>';

				foreach ($test->test_references as $test_reference) {

					if (count($test_reference->children)) {
						
						$list .='<tr><td><strong>'. $test_reference->name.'</strong></td><td></td><td></td><td></td><td></td><tr>';

						foreach ($test_reference->children as $child) {

							$list .= '<input type="hidden" name="test_reference_id[]" value="'.$child->id.'">';
							$list .='<tr><td><div style="margin-left:15px;">'.$child->name.'</div></td><td><input type="text" class="form-control" name="result[]"></td><td>'.$child->unit. '</td><td>'.$child->range.'</td><td><select name="flag[]" class="form-control" required><option value="N">Normal</option><option value="H">High</option><option value="L">Low</option></select></td><tr>';
						}

					} else {

							$list .= '<input type="hidden" name="test_reference_id[]" value="'.$test_reference->id.'">';
							$list .='<tr><td><strong>'. $test_reference->name.'</strong></td><td><input type="text" class="form-control" name="result[]"></td><td>'.$test_reference->unit. '</td><td>'.$test_reference->range.'</td><td><select name="flag[]" class="form-control" required><option value="N">Normal</option><option value="H">High</option><option value="L">Low</option></select></td></tr>';
						}
				}

			} elseif(count($test->test_references)) {

					foreach ($test->test_references as $test_reference) {

					if (count($test_reference->children)) {
						
						$list .='<tr><td><strong>'. $test->name.'</strong></td><td></td><td></td><td></td><td></td><tr>';

						foreach ($test_reference->children as $child) {

							$list .= '<input type="hidden" name="test_reference_id[]" value="'.$child->id.'">';
							$list .='<tr><td><div style="margin-left:15px;">'.$child->name.'</div></td><td><input type="text" class="form-control" name="result[]"></td><td>'.$child->unit. '</td><td>'.$child->range.'</td><td><select name="flag[]" class="form-control" required><option value="N">Normal</option><option value="H">High</option><option value="L">Low</option></select></td><tr>';
						}

					} 
					else {

							$list .= '<input type="hidden" name="test_reference_id[]" value="'.$test_reference->id.'">';
							$list .='<tr><td><strong>'. $test->name.'</strong></td><td><input type="text" class="form-control" name="result[]"></td><td>'.$test_reference->unit. '</td><td>'.$test_reference->range.'</td><td><select name="flag[]" class="form-control" required><option value="N">Normal</option><option value="H">High</option><option value="L">Low</option></select></td></tr>';
						}
					}
			} else {

				$list .= '<input type="hidden" name="test_id" value="'.$test->id.'">';
				$list .='<tr><td>'.$test->name.'</td><td colspan="4"><input type="text" class="form-control" name="result"></td></tr>';
				$list .= '</table>';
		
				return $list;
			}

			$list .= '</table>';
			$list .= '<strong>Report Comment:</strong>
					<input type="textarea" name="test_result" class="form-control">';
			return $list;
	}


	public function getImmunologyResult($test)
	{
		$list = '';

		if(count($test->test_references)) {
			//return 'here';

			$list .= $this->getReferenceResult($test);

		}	else {

			$list .='<table class="table"><tr><th>Name</th><th align="center">Result</th>';
			$list .='<tr><td><strong>'. $test->name.'</strong></td>';
			$list .= '<td><select class="form-control" name="result" required><option></option><option>Not Active</option><option>Active</option><option>Negative</option><option>Positive</option></select></td>';
			$list .= '<tr></table>';
		}
		return $list;
	}

	public function getStainResult($test)
	{
		$list = '';

		$list .='<table class="table"><tr><th>Test Name</th><th align="center">Result</th><tr>';

		foreach( $test->test_stain->test_name() as $tests) {
			$list .='<tr><td>'.$tests.'</td><td><input class="form-control" name="result[]" required></td></tr>';
		}
		$list .= '</table>';
		return $list;
	}

	public function getExaminationResult($test)
	{

		$list = '';
		$list .= '<h2>'.$test->name.'</h2>';
		$list .= '<table class="table"><tr><th>Microscopic Examination</th><th>Macroscopic Examination</th></tr><tr><td><table class="table">';

		foreach( $test->test_examination->macroscopic() as $macroscopic) {

			$list .= '<tr><td><strong>'.$macroscopic.'</strong></td><td><input name="macroscopic_result[] class="form-control" ></td></tr>';
		}

		$list .= '<tr><td colspan=2><input class="form-control" placeholder="Result" name="macroscopic_comment"></td></tr></table></td><td><table class="table">';

		foreach( $test->test_examination->microscopic() as $microscopic) {

			$list .= '<tr><td><strong>'.$microscopic.'</strong></td><td><input name="microscopic_result[] class="form-control" ></td></tr>';
		}

		$list .= '<tr><td colspan=2><input class="form-control" placeholder="Result" name="microscopic_comment"></td></tr></table></td><tr></table>';
		$list .= '<strong>Report Comment:</strong>
						<input type="textarea" name="test_result" class="form-control">';

		return $list;
	}

	public function getMicrobiologyResult($test) 
	{
		$list = '';
		$list .= '<h2>'.$test->name.'</h2>';
		$list .= '<table class="table"><tr><th>Antibiotics</th><th>Result</th></tr>';

		foreach( $test->test_antibiotics as $antibiotic) {
			//return $antibiotic->id;
			
			$list .= '<tr><td><input type="hidden" name="test_antibiotic_ids[]" value="'.$antibiotic->id.'"><strong>'.$antibiotic->name.'</strong></td><td><select  class="form-control" name="antibiotic_result[]" required><option>Sensitive</option><option>Resistant</option></select></td></tr>';
		}

		$list .= '</table><strong>Report Comment:</strong>
						<input type="textarea" name="test_result" class="form-control">';
		return $list;
	}	


	public function getWidalResult($test)
	{
		$list = '';
		$list .= '<h3>'.$test->name.'</h3>';
		$list .= '<table class="table widal-table"><tr><th>Antigens</th><th>Result</th><th>Agglutination Titre</th><th>Significant Titre</th></tr>';
		$list .= '<tr class="widal-tr"><td><input class="form-control" type="text" name="antigens[]" required value="Salmonella" autofocus></td><td>';
		$list .= '<select class="form-control" name="results[]"><option>Agglutination</option>option>No Agglutination</option></select></td><td><input class="form-control" type="text" name="agglutinations[]" required value="Less than 1:80"></td><td><div class="input-group"><input class="input-md form-control" type="text" name="significants[]" required value="Less than 1:80"><span class="delete input-group-btn"><a class="btn btn-sm btn-danger "><span class="glyphicon glyphicon-remove"></span></a></span></div></td></tr>';
		$list .= '</table><br><a class="btn-sm btn btn-danger add-more">Add More</a>';
		return $list;

	}

	public function editReferences($test, $test_report) 
	{
			$list = '';

			if(count($test->test_references)) {

				$list .='<table class="table"><tr><th>Name</th><th align="center">Result</th><th>Unit</th><th>Range</th><th>Flag</th></tr>';
			} else {

				$list .='<table class="table"><tr><th>Name</th><th colspan=4>Result</th></tr>';
			}

			if(count($test->test_references) > 1) {

				$list .= '<tr><td colspan="5"><strong>'.$test->name.'</strong><td></tr>';

				foreach ($test->test_references as $test_reference) {

					if (count($test_reference->children)) {
						
						$list .='<tr><td><strong>'. $test_reference->name.'</strong></td><td></td><td></td><td></td><td></td><tr>';

						foreach ($test_reference->children as $child) {

							$child_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $child->id)->first();

							$list .= '<input type="hidden" name="test_reference_result_id[]" value="'.$child_result->id.'">';
							$list .='<tr><td><div style="margin-left:15px;">'.$child->name.'</div></td><td><input type="text" class="form-control" name="result[]" value="'.$child_result->result.'"></td><td>'.$child->unit. '</td><td>'.$child->range.'</td><td><select name="flag[]" class="form-control" required>';

							if ($child_result->flag == "N"){
								$list .= '<option value="N" selected>Normal</option><option value="H">High</option><option value="L">Low</option></select></td><tr>';
							} elseif ($child_result->flag == "H") {
								$list .= '<option value="N" >Normal</option><option value="H" selected>High</option><option value="L">Low</option></select></td><tr>';
							} else {
								$list .= '<option value="N" >Normal</option><option value="H" >High</option><option value="L" selected>Low</option></select></td><tr>';
							}

						}

					} else {

							$test_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $test_reference->id)->first();

							$list .= '<input type="hidden" name="test_reference_result_id[]" value="'.$test_result->id.'">';
							$list .='<tr><td><strong>'. $test_reference->name.'</strong></td><td><input type="text" class="form-control" name="result[]" value="'.$test_result->result.'"></td><td>'.$test_reference->unit. '</td><td>'.$test_reference->range.'</td><td><select name="flag[]" class="form-control" required>';

								if ($test_result->flag == "N"){
									$list .= '<option value="N" selected>Normal</option><option value="H">High</option><option value="L">Low</option></select></td><tr>';
								} elseif ($test_result->flag == "H") {
									$list .= '<option value="N" >Normal</option><option value="H" selected>High</option><option value="L">Low</option></select></td><tr>';
								} else {
									$list .= '<option value="N" >Normal</option><option value="H" >High</option><option value="L" selected>Low</option></select></td><tr>';
								}
					} 
				}

			}	elseif(count($test->test_references)) {

				foreach ($test->test_references as $test_reference) {

					if (count($test_reference->children)) {
						
						$list .='<tr><td><strong>'. $test_reference->name.'</strong></td><td></td><td></td><td></td><td></td><tr>';

						foreach ($test_reference->children as $child) {

							$child_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $child->id)->first();
							//return $child_result;

							$list .= '<input type="hidden" name="test_reference_result_id[]" value="'.$child_result->id.'">';
							$list .='<tr><td><div style="margin-left:15px;">'.$child->name.'</div></td><td><input type="text" class="form-control" name="result[]" value="'.$child_result->result.'"></td><td>'.$child->unit. '</td><td>'.$child->range.'</td><td><select name="flag[]" class="form-control" required>';

							if ($child_result->flag == "N"){
								$list .= '<option value="N" selected>Normal</option><option value="H">High</option><option value="L">Low</option></select></td><tr>';
							} elseif ($child_result->flag == "H") {
								$list .= '<option value="N" >Normal</option><option value="H" selected>High</option><option value="L">Low</option></select></td><tr>';
							} else {
								$list .= '<option value="N" >Normal</option><option value="H" >High</option><option value="L" selected>Low</option></select></td><tr>';
							}

						}

					} else {

							$test_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $test_reference->id)->first();

							$list .= '<input type="hidden" name="test_reference_result_id[]" value="'.$test_result->id.'">';
							$list .='<tr><td><strong>'. $test_reference->name.'</strong></td><td><input type="text" class="form-control" name="result[]" value="'.$test_result->result.'"></td><td>'.$test_reference->unit. '</td><td>'.$test_reference->range.'</td><td><select name="flag[]" class="form-control" required>';

								if ($test_result->flag == "N"){
									$list .= '<option value="N" selected>Normal</option><option value="H">High</option><option value="L">Low</option></select></td><tr>';
								} elseif ($test_result->flag == "H") {
									$list .= '<option value="N" >Normal</option><option value="H" selected>High</option><option value="L">Low</option></select></td><tr>';
								} else {
									$list .= '<option value="N" >Normal</option><option value="H" >High</option><option value="L" selected>Low</option></select></td><tr>';
								}
						}
					}
				} else {


						$list .= '<input type="hidden" name="test_result_id" value="'.$test_report->test_result->id.'">';
						$list .='<tr><td>'.$test->name.'</td><td colspan="4"><input type="text" class="form-control" name="result" value="'.$test_report->test_result->result.'"></td></tr>';
						$list .= '</table>';
				
						return $list;
				}

				$list .= '</table>';
				$list .= '<strong>Report Comment:</strong>
						<input type="textarea" name="test_result" class="form-control" value="'.$test_report->test_result->result.'">';
				
				return $list;
	}

	public function editImmunology($test, $test_report)
	{

		$list = '';

		if (count($test->test_references)) {
			//return 'here';
			$list .= $this->editReferences($test, $test_report);

		} else {


			$list .='<table class="table"><tr><th>Name</th><th align="center">Result</th>';
			$list .='<tr><td><strong>'. $test->name.'</strong></td>';
			$list .= '<td><select class="form-control" name="result" required>';

			if ($test_report->test_result->result == 'Not Active') {
				$list .='<option selected="true">Not Active</option><option>Active</option><option>Negative</option><option>Positive</option></select></td>';
			}
			if ($test_report->test_result->result == 'Active') {
				$list .='<option>Not Active</option><option selected="true">Active</option><option>Negative</option><option>Positive</option></select></td>';
			}
			if ($test_report->test_result->result == 'Negative') {
				$list .='<option>Not Active</option><option>Active</option><option selected="true">Negative</option><option>Positive</option></select></td>';
			}
			if ($test_report->test_result->result == 'Positive') {
				$list .='<option>Not Active</option><option>Active</option><option>Negative</option><option selected="true">Positive</option></select></td>';
			}
			
			$list .= '<tr></table>';   
        }
        return $list;       
	 }


	public function editStain($test, $test_report)
	{
		$list = '';
		$list .='<table class="table"><tr><th>Test Name</th><th align="center">Result</th><tr>';
		$test_results = unserialize($test_report->test_result->result);
		$tests = $test->test_stain->test_name();
		//return $test_results;
		for ($i = 0 ; $i < count($tests); $i++) {
			$list .='<tr><td>'.$tests[$i].'</td><td><input class="form-control" name="result[]" required value="'.$test_results[$i].'"></td></tr>';
		}
		$list .= '</table>';
		//return $test->name;
		return $list;
	}

	public function editExamination($test, $test_report)
	{
		
		$list = '';

		$list .= '<h2>'.$test->name.'</h2>';
		$list .= '<table class="table"><tr><th>Microscopic Examination</th><th>Macroscopic Examination</th></tr><tr><td><table class="table">';

		$macroscopic = $test->test_examination->macroscopic();
		$macroscopic_result = unserialize( $test_report->examination_result->macroscopic_result);
		$microscopic = $test->test_examination->microscopic();
		$microscopic_result = unserialize( $test_report->examination_result->microscopic_result);

		for ($i = 0 ; $i < count($macroscopic); $i++) { 

			$list .= '<tr><td><strong>'.$macroscopic[$i].'</strong></td><td><input name="macroscopic_result[] class="form-control" required value="'.$macroscopic_result[$i].'"></td></tr>';
		}
		$result = unserialize($test_report->examination_result->result);

		$list .= '<tr><td colspan=2><input class="form-control" placeholder="Result" name="macroscopic_comment" value="'.$result["macroscopic_comment"].'"></td></tr></table></td><td><table class="table">';
			
			for ($i = 0 ; $i < count($microscopic); $i++) { 

			$list .= '<tr><td><strong>'.$microscopic[$i].'</strong></td><td><input name="microscopic_result[] class="form-control" required value="'.$microscopic_result[$i].'"></td></tr>';
		}

		$list .= '<tr><td colspan=2><input class="form-control" placeholder="Result" name="microscopic_comment" value="'.$result["microscopic_comment"].'"></td></tr></table></td></tr></table>';


		$list .= '<strong>Report Comment:</strong>
						<input type="textarea" name="test_result" class="form-control" value="'.$test_report->test_result->result.'">';

		return $list;
	}

	public function editMicrobiology($test, $test_report)
	{
		$list = '';
		$list .= '<h2>'.$test->name.'</h2>';
		$list .= '<table class="table"><tr><th>Antibiotics</th><th>Result</th></tr>';

		foreach( $test_report->test_antibiotic_results  as $antibiotic) {
			//return $antibiotic->id;
			
			$list .= '<tr><td><input type="hidden" name="test_antibiotic_ids[]" value="'.$antibiotic->id.'"><strong>'.$antibiotic->test_antibiotic->name.'</strong></td><td><select  class="form-control" name="antibiotic_result[]" required>';
			if ($antibiotic->result == 'Sensitive') {

				$list .= '<option selected>Sensitive</option><option>Resistant</option></select></td></tr>';
			} else {

				$list .= '<option >Sensitive</option><option selected>Resistant</option></select></td></tr>';
			}
			
		}
		$list .= '</table>';	
		$list .= '<strong>Report Comment:</strong><input type="textarea" name="test_result" class="form-control" value="'.$test_report->test_result->result.'">';
		return $list;
	}	

	public function editWidal($test, $test_report)
	{
		$list = '';
		$list .= '<h3>'.$test->name.'</h3>';
		$list .= '<table class="table widal-table"><tr><th>Antigens</th><th>Result</th><th>Agglutination Titre</th><th>Significant Titre</th></tr>';

		$test_result = $test_report->test_result;
		$result = unserialize($test_result->result);

		for ($i = 0; $i < count($result["results"]); $i++) { 

			$list .= '<input type="hidden" name="test_result_id" value="$test_result->id">';
			
			$list .= '<tr class="widal-tr"><td><input class="form-control" type="text" name="antigens[]" required value="'.$result["antigens"][$i].'"></td><td>';
			$list .='<select class="form-control" name="results[]">';

			if($result["results"][$i] == "Agglutination") {
				$list .= '<option selected>Agglutination</option><option>No Agglutination</option>';
			} else {
				$list .= '<option selected>No Agglutination</option><option>Agglutination</option>';
			}
			$list .= '</td><td><input class="form-control" type="text" name="agglutinations[]" required value="'.$result["agglutinations"][$i].'"></td><td><div class="input-group"><input class="input-md form-control" type="text" name="significants[]" required value="'.$result["significants"][$i].'"><span class="delete input-group-btn"><a class="btn btn-sm btn-danger "><span class="glyphicon glyphicon-remove"></span></a></span></div></td></tr>';
		}

		$list .= '</table><br><a class="btn-sm btn btn-danger add-more">Add More</a>';
		return $list;
	}
	
}
