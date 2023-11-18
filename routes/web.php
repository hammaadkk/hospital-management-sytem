<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\LabassistantController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StoreController;



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



Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'redirect'])->middleware('auth','verified');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// admin
Route::get('/add_doctor_view', [AdminController::class, 'addview']);
Route::post('/upload_doctor', [AdminController::class, 'upload']);
Route::get('/showdoctor', [AdminController::class, 'showdoctor']);
Route::get('/deletedoctor/{id}', [AdminController::class, 'deletedoctor']);
Route::get('/updatedoctor/{id}', [AdminController::class, 'updatedoctor']);
Route::post('/editdoctor/{id}', [AdminController::class, 'editdoctor']);
Route::get('/showappointment', [AdminController::class, 'showappointment']);
Route::get('/approved/{id}', [AdminController::class, 'approved']);
Route::get('/Cancelled/{id}', [AdminController::class, 'Cancelled']);
Route::get('/emailview/{id}', [AdminController::class, 'emailview']);
Route::post('/sendemail/{id}', [AdminController::class, 'sendemail']);

// home
Route::post('/appointment', [HomeController::class, 'appointment']);
Route::get('/myappointment', [HomeController::class, 'myappointment']);
Route::get('/cancel_appoint/{id}', [HomeController::class, 'cancel_appoint']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/Doctors', [HomeController::class, 'Doctors']);
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/userdash', [HomeController::class, 'userdash']);
Route::get('/book_appointment', [HomeController::class, 'book_appointment']);
Route::post('/upload_appoint', [HomeController::class, 'upload_appoint']);
Route::get('/view_appointment', [HomeController::class, 'view_appointment']);
Route::get('/view_reports', [HomeController::class, 'view_reports']);
Route::get('/download/{report}', 'HomeController@download')->name('download');
Route::get('/reports', [HomeController::class, 'showReports'])->name('reports');
Route::get('/appointments', [HomeController::class, 'viewInProgressAppointments'])->name('appointments');


// nurse
Route::get('/add_nurses', [NurseController::class, 'add_nurses']);
Route::post('/upload_nurse', [NurseController::class, 'uploadnurse']);
Route::get('/shownurse', [NurseController::class, 'shownurse']);
Route::get('/deletenurse/{id}', [NurseController::class, 'deletenurse']);
Route::get('/updatenurse/{id}', [NurseController::class, 'updatenurse']);
Route::post('/editnurse/{id}', [NurseController::class, 'editnurse']);

// Receptionists
Route::get('receptionist/fetch_name', 'ReceptionistController@fetchName')->name('receptionist.fetch_name');
Route::get('/add_receptionists', [ReceptionistController::class, 'add_receptionists']);
Route::post('/upload_receptionist', [ReceptionistController::class, 'uploadreceptionist']);
Route::get('/showreceptionist', [ReceptionistController::class, 'showreceptionist']);
Route::get('/deletereceptionist/{id}', [ReceptionistController::class, 'deletereceptionist']);
Route::get('/updatereceptionist/{id}', [ReceptionistController::class, 'updatereceptionist']);
Route::post('/editreceptionist/{id}', [ReceptionistController::class, 'editreceptionist']);
Route::get('/receptionist/book', [ReceptionistController::class, 'book']);
Route::get('/receptionist/showappointments', [ReceptionistController::class, 'showappointments']);
Route::get('/book_bed', [ReceptionistController::class, 'book_bed']);
Route::get('/receptionist/available_beds', [ReceptionistController::class, 'availableBeds']);
Route::post('/receptionist/upload_bed', [ReceptionistController::class, 'upload_bed']);
Route::post('/receptionist/check_cnic_availability', [ReceptionistController::class, 'checkCnicAvailability']);
Route::get('/book_room', [ReceptionistController::class, 'book_room']);
Route::post('/receptionist/upload_room', [ReceptionistController::class, 'upload_room']);
Route::post('/upload_appointment', [ReceptionistController::class, 'upload_appointment']);
Route::get('/receptionist/checkin', [ReceptionistController::class, 'checkin']);
Route::get('/receptionist/search', [ReceptionistController::class, 'searchpatientname'])->name('search');
Route::post('/uploadcheckin', [ReceptionistController::class, 'uploadCheckin'])->name('uploadcheckin');
Route::post('/update-status', 'ReceptionistController@updateStatus')->name('update.status');
Route::get('/receptionist/search', [ReceptionistController::class, 'searchcnic'])->name('search');
Route::post('/storeCheckin', [ReceptionistController::class, 'storeCheckin'])->name('storeCheckin');
Route::get('/fetchAppointments', [ReceptionistController::class, 'fetchAppointments']);
// GET route to display the search form
Route::get('/receptionist/payment', [ReceptionistController::class, 'showPaymentForm'])->name('receptionist.payment.form');
Route::post('/receptionist/payment', [ReceptionistController::class, 'payment'])->name('receptionist.payment');


// labassistant
Route::get('/add_labassistants', [LabassistantController::class, 'add_labassistants']);
Route::post('/upload_labassistant', [LabassistantController::class, 'uploadlabassistant']);
Route::get('/showlabassistant', [LabassistantController::class, 'showlabassistant']);
Route::get('/deletelabassistant/{id}', [LabassistantController::class, 'deletelabassistant']);
Route::get('/updatelabassistant/{id}', [LabassistantController::class, 'deletelabassistant']);
Route::post('/editlabassistant/{id}', [LabassistantController::class, 'deletelabassistant']);
Route::get('/add_test', [LabassistantController::class, 'add_test']);
Route::get('/upload_report', [LabassistantController::class, 'upload_report']);
Route::get('/add_report', [LabassistantController::class, 'add_report']);
Route::post('/upload_reportfile', [LabassistantController::class, 'upload_reportfile']);
Route::get('/showreports', [LabassistantController::class, 'showreports']);
Route::post('/upload', [LabassistantController::class, 'upload'])->name('upload');
Route::get('/download/{report}', 'LabassistantController@download')->name('download');
Route::post('/search.patients', [LabassistantController::class, 'searchPatients'])->name('search.patients');
Route::post('/search.patientsid', [LabassistantController::class, 'searchPatientsid'])->name('search.patientsid');
Route::post('/search.id', [LabassistantController::class, 'searchid'])->name('search.id');
Route::post('/search.tests', [LabassistantController::class, 'searchTests'])->name('search.tests');
Route::post('/get-test-charges', [LabassistantController::class, 'getTestCharges'])->name('get.test.charges');
Route::post('/get-patient-name', [LabassistantController::class, 'getPatientName'])->name('get.patient.name');
Route::post('/get-doctor-info', [LabassistantController::class, 'getDoctorInfo'])->name('get.doctor.info');
Route::get('/search', [LabassistantController::class, 'searchtestname'])->name('search.testsname');
Route::get('/fetch-test-charges', [LabassistantController::class, 'fetchTestCharges'])->name('fetch.testcharges');
Route::get('/view_all_tests', [LabassistantController::class, 'view_all_tests']);
Route::get('/edit/{id}', [LabassistantController::class, 'edit'])->name('edit.test');
Route::delete('/delete/{id}', [LabassistantController::class, 'destroy'])->name('delete.test');
Route::put('/update/{id}', [LabassistantController::class, 'update'])->name('update.test');
Route::post('/add', [LabassistantController::class, 'add'])->name('add');


Route::group(['prefix' => 'nurse'], function() {
	Route::group(['middleware' => 'nurse.guest'], function(){
		Route::view('/login','nurse.login')->name('nurse.login');
		Route::post('/login',[App\Http\Controllers\NurseController::class, 'authenticate'])->name('nurse.auth');
	});
	
	Route::group(['middleware' => 'nurse.auth'], function(){
		Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'dashboard'])->name('nurse.dashboard');
	});
});

Route::group(['prefix' => 'receptionist'], function() {
	Route::group(['middleware' => 'receptionist.guest'], function(){
		Route::view('/login','receptionist.login')->name('receptionist.login');
		Route::post('/login',[App\Http\Controllers\ReceptionistController::class, 'authenticate'])->name('receptionist.auth');
	});
	
	Route::group(['middleware' => 'auth:receptionist'], function () {
		Route::get('/dashboard', [App\Http\Controllers\ReceptionistController::class, 'dashboard'])->name('receptionist.dashboard');
		Route::get('/logout', [App\Http\Controllers\ReceptionistController::class, 'logout'])->name('receptionist.logout');
	});
	
});

Route::group(['prefix' => 'labassistant'], function() {
	Route::group(['middleware' => 'labassistant.guest'], function(){
		Route::view('/login','labassistant.login')->name('labassistant.login');
		Route::post('/login',[App\Http\Controllers\LabassistantController::class, 'authenticate'])->name('labassistant.auth');
	});
	
	Route::group(['middleware' => 'labassistant.auth'], function(){
		Route::get('/dashboard',[App\Http\Controllers\LabDashboardController::class, 'dashboard'])->name('labassistant.dashboard');
	});
});

Route::group(['prefix' => 'doctor'], function() {
	Route::group(['middleware' => 'doctor.guest'], function(){
		Route::view('/login','doctor.login')->name('doctor.login');
		Route::post('/login',[App\Http\Controllers\doctorController::class, 'authenticate'])->name('doctor.auth');
	});
	
	Route::group(['middleware' => 'doctor.auth'], function(){
		Route::get('/dashboard',[App\Http\Controllers\DoctorController::class, 'dashboard'])->name('doctor.dashboard');
	});

	Route::group(['prefix' => 'store'], function() {
		Route::group(['middleware' => 'store.guest'], function(){
			Route::view('/login','store.login')->name('store.login');
			Route::post('/login',[App\Http\Controllers\StoreController::class, 'authenticate'])->name('Store.auth');
		});
		
		Route::group(['middleware' => 'store.auth'], function(){
			Route::get('/dashboard',[App\Http\Controllers\StoreController::class, 'dashboard'])->name('store.dashboard');
		});
	});
	
});
