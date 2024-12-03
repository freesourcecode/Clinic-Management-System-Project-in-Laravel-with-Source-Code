<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Tax;
use Config;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function setting()
    {
    	$hospital = Hospital::find(1);
        //return $config;
    	return view('hospital.setting', compact('hospital'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateHospital(Request $request, $id)
    {
        $hospital = Hospital::find($id);
        $this->validate($request, [
            'name' => 'required',
            'slogan' => 'required',
            
            'address'=>'required',
            'contact'=>'required',
            'email'=>'required',
        ]);
        $data = $request->all();
        $hospital->update($data);
        return back()
            ->with('success', 'Hospital Setting updated successfully');
    }

    public function updateTax(Request $request, $id)
    {
        $tax = Tax::find($id);
        $this->validate($request, [
            'name' => 'required',
            'percent' => 'required',
        ]);
        $data = $request->all();
        $tax->update($data);
        return back()
            ->with('success', 'Tax Setting updated successfully');
    }

    public function updateConfig(Request $request)
    {
        $data = $request->all();
        //return $data['invoice_prefix'];
        Config::set('hms.prefix', $data);
            return back()
            ->with('success', 'Prefix changed updated successfully');
         
    }

    public function backup(Request $request)
    {

        //ENTER THE RELEVANT INFO BELOW
        $db_name = env('DB_DATABASE', 'hms');
        $db_user = env('DB_USERNAME', 'root');
        $db_password = env('DB_PASSWORD', 'root');
        $db_host = env('DB_HOST', '127.0.0.1z');
        $backup_path = public_path( date('Y-M-d').'.sql');

        //DO NOT EDIT BELOW THIS LINE
        //Export the database and output the status to the page
        $command = 'mysqldump --opt -h' .$db_host .' -u' .$db_user .' -p' .$db_password .' ' .$db_name .' > ' .$backup_path;

        //return $command;
        $output = array();
        $worked = '';

        exec($command, $output , $worked);

        //return $worked;

        switch($worked) {

            case 0:
                    return redirect('/')->with('success', 'Database back up successfully..');
            break;
            case 1:
                    return redirect('/')->withErrors('Backup cannot complete... please try again later.');
            break;
            case 2:
                    return redirect('/')->withErrors('Backup cannot complete... please try again later.');
            break;
        }
    }
        
}
