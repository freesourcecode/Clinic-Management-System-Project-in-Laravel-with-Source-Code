<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Patient;
use App\Models\Invoice;
use App\Models\Hospital;
use App\Models\Test;
use App\Models\Doctor;
use App\Models\ServiceSale;
use App\Models\TestReport;
use App\Models\TestResult;
use App\Models\ResultValue;
use App\Models\TestAntibiotic;
use App\Models\TestAntibioticResult;
use App\Models\TestReferenceResult;
use Auth;
use PDF;

class ReportController extends Controller
{
	public function index()
	{
		
		$reports = Report::orderBy('created_at', 'DESC')->get();
		return view('reports.index', compact('reports'));
	}

    public function edit($id)
    {
        //return $id;
        $hospital = Hospital::first();
        $report = Report::find($id);
        $tests = $report->test_reports()->get();
        //return $tests;
        $list = '<strong>Patient ID#:'.$hospital->patient_prefix.$report->patient_id.'</strong><br><br><strong>Sample Collect</strong><br><b>------------------</b><br><input name="id" type="name" class="hidden form-control" value="'.$report->id.'" >';
       foreach($tests as $test)
       {
        // return $test;
            if($test->sample == 1)
            {
                $list .= '<strong>'.$test->test->name.':  <span class="glyphicon glyphicon-ok"></span>Sample Collect</strong><br>';
            }
            else
            {
                $list .= '<strong>'.$test->test->name.': </strong> <input type="checkbox" name="sample[]" value="'. $test->id.'"><br>';  

            }
       }
       return $list;

    }
    public function update(Request $request)
    {
        //return $request->all();
        $report = Report::find($request->id);
        $tests = TestReport::where('report_id', $report->id)->get();
        $test_report = [];
        //return $tests;
        foreach($tests as $test)
        {
             if($request->sample)
            {

            foreach($request->sample as $sample)
            {
                if($sample == $test->id)
                {
                    $test_report['sample'] = 1;
                    $test = TestReport::find($test->id);
                    $test->update($test_report);
                }
                   
            }
        }
        
       }

       return back()->with('success', 'Sample Collect successfully');
    }

    public function printReport($id)
    {
        // /return $id;
        $report = Report::find($id);
        //return $report->test_reports;
        $setting = Hospital::first();
        $haematology_tests = TestReport::where('report_id', $report->id)->where('report_type', 'haematology')->where('status', 1)->get();
        $biochemistry_tests = TestReport::where('report_id', $report->id)->where('report_type', 'biochemistry')->where('status', 1)->get();
        $stain_tests = TestReport::where('report_id', $report->id)->where('report_type', 'stain')->where('status', 1)->get();

        $immunology_tests = TestReport::where('report_id', $report->id)->where('report_type', 'immunology')->where('status', 1)->get();

        $examination_tests = TestReport::where('report_id', $report->id)->where('report_type', 'examination')->where('status', 1)->get();

        $microbiology_tests = TestReport::where('report_id', $report->id)->where('report_type', 'microbiology')->where('status', 1)->get();

        $widal_tests = TestReport::where('report_id', $report->id)->where('report_type', 'widal')->where('status', 1)->get();

       // return $haematology_tests;
        $list = '';
        $list .= '<style>td {font-style: small;font-weight:normal;}</style>';
        $list .='<div style="margin-left:50px; ">';

        if (count($haematology_tests)) {

            $list .= $this->getHeader($report,  $setting);
            $list .= $this->haematologyReport($haematology_tests);
            $list .= $this->getFooter($report);
            
        }

        if (count($biochemistry_tests)) {

            $list .= $this->getHeader($report, $setting);
            $list .= $this->biochemistryReport($biochemistry_tests);
            $list .= $this->getFooter($report);

        }

        if (count($stain_tests)) {

            $list .= $this->getHeader($report, $setting);
            $list .= $this->stainReport($stain_tests);
            $list .= $this->getFooter($report);
            
        }

        if (count($immunology_tests)) {

            $list .= $this->getHeader($report, $setting);
            $list .= $this->immunologyReport($immunology_tests);
            $list .= $this->getFooter($report);
            
        }

         if (count($examination_tests)) {

            $list .= $this->getHeader($report, $setting);
            $list .= $this->examinationReport($examination_tests);
            $list .= $this->getFooter($report);

        }
        /*Microbilogy Report*/

        if (count($microbiology_tests)) {
            $list .= $this->getHeader($report, $setting);
            $list .= $this->microbiologyReport($microbiology_tests);
            $list .= $this->getFooter($report);
        }
        /*Widal Report*/

        if(count($widal_tests)) {

            $list .= $this->getHeader($report, $setting);
            $list .= $this->widalReport($widal_tests);
            $list .= $this->getFooter($report);
        }
        $list .= '</div>';      
        
        //return $list;
        $pdf = PDF::loadHtml($list);
        $pdf->save(public_path().'/reports/'.$report->patient->first_name.$report->id.'.pdf');
        $data['report'] = $report->patient->first_name.$report->id.'.pdf';
        $test_report_status = $report->test_reports()->where('status', 1)->get();
        $test_reports = $report->test_reports;
        if ( count($test_report_status) == count($test_reports)) {
            $data['status'] = 1;
        }
        $report->update($data);
        return $pdf->stream('invoice.pdf');
       //return $list;
    }

    public function editResult(Request $request)
    {
        //return $request->all();
        $report = Report::find($request->id);
        $data['id'] = $request->id;
        $data['result'] = $request->result;
        $data['status'] = 1;

        //return $data;
        $reports =  $report->update($data);
        //return $report;

        $print = $this->printReport($reports->id);
        return response ()->json ( $reports );
    }


    public function haematologyReport($test_reports) 
    {
        $list = '';
        $list .= '<h3 align="center">HAEMATOLOGY REPORT</h3>';
        $list .= $this->referenceReport($test_reports);
        return $list;
        
    }

    public function referenceReport($test_reports)
    {

        $list = '';
        $list .= '<table border="0" cellpadding="2" cellspacing="0"  style="width:100%;"><thead><tr><th><u>Test Name</th><th><u>Result</th><th><u>Flag</th><th><u>Unit</th><th><u>Range</th></tr></thead><tbody>';

            foreach($test_reports as $test_report) {

                if(count($test_report->test->test_references) > 1) {

                    $list .= '<tr><td colspan="4"><u><strong>'.$test_report->test->name.'</strong></u><td></tr>';

                    foreach ($test_report->test->test_references as $test_reference) {

                        if (count($test_reference->children)) {
                            
                            $list .='<tr><td colspan="4"><u><strong>'. $test_reference->name.'</strong><u></td></tr>';

                            foreach ($test_reference->children as $child) {

                                $child_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $child->id)->first();

                                $list .='<tr><td><div style="margin-left:15px;">'.$child->name.'</div></td><td>'.$child_result->result.'</td>';

                                if($child_result->flag == 'N') {
                                   $list .= '<td></td>';
                                } else {
                                    $list .= '<td>'.$child_result->flag. '</td>';
                                }
                                $list .= '<td>'.$test_reference->unit. '</td><td>'.$child->range.'</td></tr>';
                            }
                        } else {

                                $test_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $test_reference->id)->first();

                                $list .='<tr><td><strong>'. $test_reference->name.'</strong></td><td>'.$test_result->result.'</td>';

                                if($test_result->flag == 'N') {
                                   $list .= '<td></td>';
                                } else {
                                    $list .= '<td>'.$test_result->flag. '</td>';
                                }

                                $list .= '<td>'.$test_reference->unit. '</td><td>'.$test_reference->range.'</td></tr>';
                        }
                    }
                } elseif(count($test_report->test->test_references)) {

                    foreach ($test_report->test->test_references as $test_reference) {

                        if (count($test_reference->children)) {
                                    
                            $list .='<tr><td colspan="4"><strong>'. $test_reference->name.'</strong></td><tr>';

                                foreach ($test_reference->children as $child) {

                                    $child_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $test_reference->id)->first();

                                    $list .='<tr><td><div style="margin-left:15px;">'.$child->name.'</div></td><td>'.$child_result->result.'</td>';

                                     if($child_result->flag == 'N') {
                                       $list .= '<td></td>';
                                    } else {
                                        $list .= '<td>'.$child_result->flag. '</td>';
                                    }

                                    $list .= '<td>'.$child->unit. '</td><td>'.$child->range.'</td></tr>';
                                }

                        } else {

                                $test_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $test_reference->id)->first();

                                $list .='<tr><td><strong>'. $test_reference->name.'</strong></td><td>'.$test_result->result.'</td>';

                                if($test_result->flag == 'N') {
                                   $list .= '<td></td>';
                                } else {
                                    $list .= '<td>'.$test_result->flag. '</td>';
                                }

                                $list .= '<td>'.$test_reference->unit. '</td><td>'.$test_reference->range.'</td></tr>';
                        }
                    }
                } else {
                                
                        $list .='<tr><td><strong>'. $test_report->test->name.'</strong></td><td colspan="3">'.$test_report->test_result->result.'</td></tr>';
                }
            }
                               
            $list .='</tbody></table>';
            return $list;
    }

    public function biochemistryReport($test_reports) 
    {

        $list = '';
        $list .= '<br><h3 align="center">BIOCHEMISTRY REPORT</h3>';
        $list .= $this->refrenceReport($test_reports);
        return $list;
    }


    public function stainReport($test_reports) 
    {
        $list = '';
        foreach ($test_reports as $test_report) {

            $list .= '<br><h3 align="center">SPUTUM for '.$test_report->test->name.' Report</h3>';
            $list .= '<table border="1" cellpadding="3" cellspacing="0"  style="width:100%; margin-bottom:50px;"><tr><th><u align="center">Test Name</u></th><th align="center">Result</th></tr>';
            $test_results = unserialize($test_report->test_result->result);

            $tests = $test_report->test->test_stain->test_name();

            for ($i = 0 ; $i < count($tests); $i++) {

                $list .='<tr><td>'.$tests[$i].'</td><td>'.$test_results[$i].'</td></tr>';
            }
            $list .= '</table> ';  
        }
                   
        return $list;  
    }


    public function immunologyReport($test_reports)
    {

        $list = '';
        $list .= '<br><h3 align="center">IMMUNOLOGY REPORT</h3>';

        foreach ($test_reports as $test_report) {

            if(count($test_report->test->test_references)) {

                
                $list .= '<table border="0" cellpadding="3" cellspacing="0"  style="width:100%; margin-bottom:30px;"><thead><tr><th><u>Test Name</th><th><u>Result</th><th><u>Unit</th><th><u>Range</th><th><u>Flag</th></tr></thead><tbody>';

                foreach ($test_report->test->test_references as $test_reference) {

                    if (count($test_reference->children)) {
                        
                        $list .='<tr><td colspan="4"><strong>'. $test_reference->name.'</strong></td></tr>';

                        foreach ($test_reference->children as $child) {

                            $child_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $child->id)->first();

                            $list .='<tr><td><div style="margin-left:15px;">'.$child->name.'</div></td><td>'.$child_result->result.'</td><td>'.$child->unit. '</td><td>'.$child->range.'</td><td>'.$child_result->flag .'</td></tr>';
                        }

                    } else {

                        $test_result = TestReferenceResult::where('test_report_id', $test_report->id)->where('test_reference_id', $test_reference->id)->first();

                        $list .='<tr><td><strong>'. $test_reference->name.'</strong></td><td>'.$test_result->result.'</td><td>'.$test_reference->unit. '</td><td>'.$test_reference->range.'</td><td>'.$test_result->flag.'</td></tr>';
                    }
                }

                $list .= '</tbody></table><br>'; 
            } else {

                
                $list .= '<table border="1" cellpadding="5" cellspacing="0"  style="width:100%; margin-bottom:30px;"><thead><tr><th>Test Name</th><th align="center">Result</th></thead><tbody>';

                $list .='<tr><td><strong>'. $test_report->test->name.'</strong></td><td>'.$test_report->test_result->result.'</td></tr>';
                $list .= '</tbody></table><br>';  
            }  
        }

             
        return $list;
    }   


    public function examinationReport($test_reports)
    {

        $list = '';
        foreach ($test_reports as $test_report) {

            $list .= '<br><h3 align="center">PARASITOLOGY REPORT</h3>';
            $list .= '<h4 align="center"><u>'.$test_report->test->name.'</u></h4>';
            $list .= '<table border="1" cellpadding="3" cellspacing="0"  style="width:100%;"><tr><td> Physical  Examination</td><td>Microscopy Examination</td></tr><tr><td><table width="100%" >';

            $macroscopic = $test_report->test->test_examination->macroscopic();
            $macroscopic_result = unserialize( $test_report->examination_result->macroscopic_result);
            //return $macroscopic_result;
            $microscopic = $test_report->test->test_examination->microscopic();
            $microscopic_result = unserialize( $test_report->examination_result->microscopic_result);

            for ($i = 0 ; $i < count($macroscopic); $i++) { 

                $list .= '<tr><td>'.$macroscopic[$i].'</td><td>'.$macroscopic_result[$i].'</td></tr>';
            }
            $list .= '</table></td><td><table width="100%">';

            for ($i = 0 ; $i < count($microscopic); $i++) { 

            $list .= '<tr><td>'.$microscopic[$i].'</td><td> '.$microscopic_result[$i].'</td></tr>';
            }

            $result = unserialize($test_report->examination_result->result);

            $list .= '</table></td></tr>';
            if ($result["macroscopic_comment"] || $result["microscopic_comment"]) {

                $list .= '<tr><td>   '.$result["macroscopic_comment"].'</td>';
                $list .= '<td>  '.$result["microscopic_comment"].'</td></tr>';
            }
            $list .= '</table>';
            $list .= '<p><br>'.$test_report->test_result->result.'</p>';


        }

        return $list;
    } 


    public function microbiologyReport($test_reports) 
    {
        $list = '';
        $list .= '<br><div align="center" style="margin-top:30px;"><b>MICROBIOLOGY REPORT</b></div>';

            foreach($test_reports as $test_report) {

                $list .= '<u><h4 align="center">'.$test_report->test->name.'</h4></u>';
                
                if(count($test_report->test_result)) {
                    $list .= '<b>Result: </b>';
                    $list .= '<b style="font-weight:normal">'.$test_report->test_result->result.'</b>';
                }
                $list .= '<table border="1" cellpadding="5" cellspacing="0"  style="width:100%; margin-bottom:30px; margin-top:50px;" align="center" ><tr><th><strong><u>Antibiotics</u></strong></th><th><strong><u>Result</u></strong></th></tr>';

                $test_antibiotic_results = $test_report->test_antibiotic_results;

                foreach($test_antibiotic_results as $test_result) {

                    $list .= '<tr><td><i>'.$test_result->test_antibiotic->name.'</i></td><td>'.$test_result->result.'</td></tr>';
                }

            $list .= '</table>';
            }
            return $list;
    }//

    /*Widal Test*/

    public function widalReport($widal_tests)
    {
        $list = '';
        $list .= '<br><div align="center" style="margin-top:30px;"><b>HAEMATOLOGY REPORT</b></div>';
        foreach ($widal_tests as $test) {
           
            $list .= '<h3 align="center">'. $test->test->name.'</h3>';
            $test_result = $test->test_result;
            $result = unserialize($test_result->result);

            $list .= '<table border="1" cellpadding="5" cellspacing="0"  style="width:100%; margin-bottom:30px;" align="center"><tr><th>Antigens</th><th>Result</th><th>Agglutination Titre</th><th>Significant Titre</th></tr>';


            for ($i=0; $i < count($result["results"]); $i++) { 

                $list .= '<tr><td>'.$result["antigens"][$i].'</td><td>'.$result["results"][$i].'</td><td>'.$result["agglutinations"][$i].'</td><td>'.$result["significants"][$i].'</td></tr>';
           }

           $list .= '</table>';
        }

        return $list;
        
    }


    public function getHeader($report, $setting) 
    {
        $list = '';
        $list .='<div style="margin-top:160px;  position:relative">';
        $list .= '<div style="float:left; right:0px; width:400px;"><strong>Patient Name     : '.$report->patient->first_name.' '.$report->patient->middle_name.' '.$report->patient->last_name.'</strong><br><strong>Patient ID#: '.$setting->patient_prefix.$report->patient_id.'</strong><br><strong>Age: '. $report->patient->age.'Yrs.</strong><br><strong>Sex: '.$report->patient->gender.'</strong></div>';
        $list .= '<div style="position:relative;"><strong>Report ID#: '.$report->id.'</strong><br><strong>Collection Date: '.$report->created_at->todatestring().'</strong><br><strong>Report Date: '.$report->updated_at->todatestring().'</strong><br><strong>Referred By:';

        if ($report->doctor_id) {

            $doctor = Doctor::find($report->doctor_id);
            $list .= $doctor->employee->first_name.' '.$doctor->employee->last_name.'</strong></div></div><br><br><br>';
        }
        return $list;
    }  

    public function getFooter($report) 
    {
        $list = '';
         if ($report->result) {

                    $list .= '<strong>Description:<div style="border:1px;>'.$report->result.'</div></strong>    ';
        }

        $list .='<table style="width:100%; margin:30px;" align="center"><tr><td>----------------</td><td>------------------</td><td>----------------<td></tr>';
        $list .='<tr><td>    <strong>Technician</strong>   </td><td>    <strong>Technologist</strong>   </td><td>   <strong>Pathologist</strong>   </td></tr></table><br>';
       
        $list .= '<div align="left">Date:  '.date('Y-m-d h:m').'</strong><br>Report By : '.Auth::user()->name.'</div><div style="page-break-after: always;
        page-break-inside: avoid;"></div>';
        return $list;
    }

}
