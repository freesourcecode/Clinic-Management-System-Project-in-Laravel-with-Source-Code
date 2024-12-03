<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/amount', function()
{
	$amount = App\Models\Service::get();

	foreach($amount as $amt) {

		$data["amount"] = $amt->amount*20/21;
		$amt->update($data);
	}
	

	return 'Complete';

});

Auth::routes();
Route::get('/invoice/calculate/', 'InvoiceController@calculate');
Route::get('/days/{id}','DoctorApiController@getDays');

Route::group(array('middleware'=>['auth']), function() {


		Route::get('backup', ['as' => 'hospital.backup', 'uses' => 'HospitalController@backup']);
		Route::get('/',['as'=>'dashboard.index', 'uses'=>'DashboardController@index']);
		Route::get('setting',['as' => 'hospital.setting', 'uses' => 'HospitalController@setting']);
		Route::post('change/password', ['as'=>'change.password', 'uses'=>'UserController@changePassword']);
		Route::post('hospital/update/{id}', ['as'=>'hospital.update', 'uses'=>'HospitalController@updateHospital']);
		Route::post('tax/update/{id}', ['as'=>'tax.update', 'uses'=>'HospitalController@updateTax']);
		Route::post('config/update/', ['as'=>'config.update', 'uses'=>'HospitalController@updateConfig']);
		// User Route
		Route::get('user',['as'=>'user.index', 'uses' => 'UserController@index']);
		Route::post('user', ['as'=>'user.store', 'uses'=> 'UserController@store']);
		Route::post('user/edit/', ['as'=>'user.edit', 'uses'=> 'UserController@edit']);
		Route::post('user/delete/', ['as'=>'user.delete', 'uses'=> 'UserController@delete']);
		// Department Route
		Route::get('department/', ['as'=>'department.index', 'uses'=>'DepartmentController@getIndex']);
		Route::post('department/add', ['as'=>'department.add', 'uses'=>'DepartmentController@store']);
		Route::post('department/edit', ['as'=>'department.edit', 'uses'=>'DepartmentController@edit']);
		Route::post('department/delete',['as'=>'department.delete','uses'=>'DepartmentController@delete']);
		//Services Route
		Route::get('service/', ['as'=>'service.index', 'uses'=>'ServiceController@getIndex']);
		Route::post('service/add', ['as'=>'service.add', 'uses'=>'ServiceController@store']);
		Route::post('service/edit', ['as'=>'service.edit', 'uses'=>'ServiceController@edit']);
		Route::post('service/delete',['as'=>'service.delete','uses'=>'ServiceController@delete']);

		Route::resource('employee', 'EmployeeController');
		Route::resource('doctor', 'DoctorController');
		Route::resource('doctor', 'DoctorController');
		Route::resource('patient', 'PatientController');
		Route::resource('appointment', 'AppointmentController');
		Route::resource('role', 'RoleController');

		//Package Route
		Route::get('package', ['as'=>'package.index', 'uses'=>'PackageController@getIndex']);
		Route::post('package', ['as'=>'package.store', 'uses'=>'PackageController@store']);
		Route::post('package/edit', ['as'=>'package.edit', 'uses'=>'PackageController@edit']);
		Route::post('package/test/delete', ['as'=>'package.test.delete', 'uses'=>'PackageController@packageTestDelete']);
		Route::post('pacakge/delete', ['as'=>'package.delete', 'uses'=>'PackageController@delete']);

		Route::post('appointment/updated',['as'=>'appointment.updated','uses'=>'AppointmentController@updated']);

		Route::get('invoice', ['as'=>'invoice.index', 'uses'=>'InvoiceController@index']);
		Route::post('invoice', ['as'=>'invoice.store', 'uses'=>'InvoiceController@store']);
		Route::get('invoice/patient/{patient_id}', ['as'=>'invoice.patient', 'uses'=> 'InvoiceController@patient']);
		Route::get('invoice/remove/{id}', ['as'=> 'invoice.remove', 'uses'=>'InvoiceController@remove']);
		Route::get('invoice/sales/{id}',['as' => 'invoice.sale', 'uses' => 'InvoiceController@tempSales']);
		Route::get('invoice/opd/{id}',['as' => 'invoice.opd', 'uses'=> 'OpdController@opdSales']);
		Route::get('invoice/report', ['as'=>'invoice.report', 'uses'=>'InvoiceController@report']);
		Route::get('invoice/duplicate/{id}', ['as'=>'invoice.duplicate', 'uses'=>'InvoiceController@duplicate']);

		Route::get('search/invoice', ['as'=>'search.invoice', 'uses'=>'InvoiceController@searchInvoice']);

		Route::post('invoice/return', ['as'=>'invoice.return', 'uses'=>'InvoiceController@invoiceReturn']);

		Route::get('opd',['as'=>'opd.index', 'uses'=>'OpdController@getindex']);
		Route::post('opd',['as'=>'opd.store', 'uses'=>'OpdController@store']);

		Route::post('package/sale', ['as'=>'package.sale', 'uses'=>'PackageController@packageSale']);

		Route::get('package/sale',['as' => 'package.sale', 'uses' => 'PackageController@sale']);
		Route::get('package/sale/{id}', ['as'=>'package.sales', 'uses'=>'PackageController@packageSales']);
		//Test Route
		Route::get('test', ['as'=>'test.index','uses'=>'TestController@index']);
		Route::post('test/{id}/status', ['as'=>'test.status', 'uses'=>'TestController@statusChange']);
		Route::post('test/add', ['as'=>'test.store', 'uses'=>'TestController@store']);
		Route::post('test/edit', ['as'=>'test.edit', 'uses'=>'TestController@edit']);
		Route::post('test/delete', ['as'=>'test.delete', 'uses'=>'TestController@delete']);
		//Test Reference Route
		Route::get('reference', ['as'=>'reference.index','uses'=>'ReferenceTestController@index']);
		Route::post('reference', ['as'=>'reference.store', 'uses'=>'ReferenceTestController@store']);
		Route::post('reference/update', ['as'=>'reference.update', 'uses'=>'ReferenceTestController@edit']);
		Route::post('reference/delete', ['as'=>'reference.delete', 'uses'=>'ReferenceTestController@delete']);
		Route::post('antibiotic', ['as'=>'antibiotic.store', 'uses' => 'MicrobiologyController@storeAntibiotic']);
		Route::post('antibiotic/edit', ['as'=>'antibiotic.edit', 'uses' => 'MicrobiologyController@editAntibiotic']);

		Route::get('haematology', ['as' => 'haematology.index', 'uses' => 'HaematologyController@index']);
		Route::post('haematology',['as' => 'haematology.store', 'uses' => 'HaematologyController@store']);

		Route::get('immunology', ['as' => 'immunology.index', 'uses' => 'ImmunologyController@index']);
		Route::post('immunology',['as' => 'immunology.store', 'uses' => 'ImmunologyController@store']);

		Route::get('microbiology', ['as' => 'microbiology.index', 'uses' => 'MicrobiologyController@index']);
		Route::post('microbiology', ['as' => 'microbiology.store', 'uses' => 'MicrobiologyController@store']);
		Route::get('examination', ['as' => 'examination.index', 'uses' => 'ExaminationController@index']);
		Route::post('examination', ['as' => 'examination.store', 'uses' => 'ExaminationController@store']);
		Route::post('examination/update', ['as' => 'examination.update', 'uses' => 'ExaminationController@update']);
		Route::get('biochemistry', ['as' => 'biochemistry.index', 'uses' => 'BiochemistryController@index']);
		Route::post('biochemistry', ['as' => 'biochemistry.store', 'uses' => 'BiochemistryController@store']);
		Route::get('stain', ['as' => 'stain.index', 'uses' => 'StainController@index']);
		Route::post('stain', ['as' => 'stain.store', 'uses' => 'StainController@store']);
		Route::post('stain/edit', ['as' => 'stain.edit', 'uses' => 'StainController@edit']);
		//Report Route
		Route::get('report', ['as'=>'report.index','uses'=>'ReportController@index']);
		Route::post('report/{id}/status',['as' =>'report.status', 'uses'=> 'ReportController@statusChange']);
		Route::get('report/edit/{id}',['as' => 'report.edit', 'uses' =>'ReportController@edit']);
		Route::get('report/patient/{patient_id}',['as' => 'report.patient', 'uses'=>'ReportController@patient']);
		Route::post('report/update',['as'=>'report.update', 'uses'=>'ReportController@update']);
		Route::get('report/print/{id}',['as'=>'report.print', 'uses' => 'ReportController@printReport']);
		//Result Route
		Route::get('result/test/{id}',['as' => 'result.test', 'uses' => 'ResultController@getTest']);
		Route::get('result/tests/{id}',['as' => 'result.tests', 'uses' => 'ResultController@getTests']);
		Route::post('result', ['as'=>'result.store', 'uses'=>'ResultController@store']);
		Route::post('result/edit', ['as'=>'result.edit', 'uses'=>'ResultController@edit']);
		Route::get('generate/report/{report_id}',['as'=>'report.generate', 'uses'=> 'ResultController@generateReport']);
		Route::get('result/comment/edit',['as'=>'report.comment','uses'=>'ResultController@editComment']);
		Route::get('report/result/edit', ['as'=>'report.result', 'uses'=>'ReportController@editResult']);

		Route::get('account/service', ['as' => 'account.service', 'uses' => 'AccountController@serviceReport']);
		Route::get('account/opd', ['as' => 'account.opd', 'uses' => 'AccountController@opdReport']);
		Route::get('account/package', ['as' => 'account.package', 'uses' => 'AccountController@packageReport']);
	});
