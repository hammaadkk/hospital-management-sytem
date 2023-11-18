<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;

use App\Models\Receptionist;
use App\Models\Labassistant;
use App\Models\Appointment;
use App\Models\Report;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function showReports(Request $request)
    {
        $status = $request->input('status', 'all');
    
        // Fetch all appointments or filter them based on the status
        if ($status === 'not_uploaded') {
            $report = Report::whereNull('file')->get();
        } else {
            $report = Report::all();
        }
    
        // Pass the status filter to the view
        return view('userdashboard.reports', ['report' => $report, 'status' => $status]);
    }
    public function redirect()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            
            if($user->usertype !== null && $user->usertype == '0')
            {
                $doctor = Doctor::all();
                return view('user.home', compact('doctor'));
            }
            else
            {
                $doctorsCount = Doctor::count();
                
                $ReceptionistsCount = Receptionist::count();
                $LabassistantsCount = Labassistant::count();
                $AppointmentsCount = Appointment::count();
                $approvedAppointmentsCount = Appointment::where('status', 'Approved')->count();
                $inprogessAppointmentsCount = Appointment::where('status', 'in progress')->count();
                $CancelledAppointmentsCount = Appointment::where('status', 'Cancelled')->count();
                return view('admin.home', compact('doctorsCount','ReceptionistsCount', 'LabassistantsCount', 'AppointmentsCount', 'approvedAppointmentsCount', 'inprogessAppointmentsCount', 'CancelledAppointmentsCount'));
            }
        }
        else
        {
            return redirect()->back();
        }
    }
    

    public function index()
    {
        if(Auth::id())
        {
            return redirect('home');
        }
        else
        {
            $doctor = doctor::all();
            return view('user.home', compact('doctor'));
        }
    }

   
    public function appointment(Request $request)
{   
    $data = new appointment;

    $data->name = $request->name;
    $data->father_name = $request->fname;
    $data->cnic_no = $request->cnic_no;
    $data->email = $request->email;
    $data->phone = $request->number;
    $data->doctor = $request->doctor;
    $data->date = $request->date;
    $data->message = $request->message;
    $data->status = 'in progress';

    // Set 'Is_Deleted' and 'Is_Completed' to 0
    $data->Is_Deleted = 0;
    $data->Is_Completed = 0;

    $matchingDoctor = Doctor::where('name', $data->doctor)->first();

    if ($matchingDoctor) {
        // If a matching doctor is found, set 'doctor_id' to the matching doctor's ID.
        $data->doctor_id = $matchingDoctor->id;
    }

    if (Auth::id()) {  
        $data->patient_id = Auth::user()->id;
    }

    $data->save(); 

    return redirect()->back()->with('message', 'Appointment Request Successful. We will contact you soon');
}

    public function cancel_appoint($id)
    {
        $data=appointment::find($id);
        $data->delete();
        return redirect()->back();
    }

    function about(){
        $doctor = doctor::all();
        return view('user.about',compact('doctor'));
        // return view('user.about');

    }

    function Doctors(){
        $doctor = doctor::all();
        return view('user.Doctors',compact('doctor'));
      
        
    }

    function blog(){
        return view('user.blog');
    }

    function contact(){
        return view('user.contact');
    }
    public function userdash()
{
    
    $user = Auth::user();
    $totalAppointments = $user->appointments()->count();
    $totalReports = $user->reports()->count();
    $pendingReportsCount = $user->reports()->where('status', 'in process')->count();
    $pendingAppointmentsCount = $user->appointments()->where('status', 'in progress')->count();
    $lineChartData = Appointment::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count")
        ->where('patient_id', $user->id)
        ->whereNotNull('patient_id')
        ->groupBy('month')
        ->get();

    $formattedLineChartData = $lineChartData->map(function ($data) {
        $dateParts = explode('-', $data->month);
        return [
            'month' => date('F', mktime(0, 0, 0, intval($dateParts[1]), 1)),
            'count' => $data->count,
        ];
    });
    
    $formattedLineChartDataJson = $formattedLineChartData->toJson();

    
    return view('userdashboard.userdash', [
        'totalAppointments' => $totalAppointments,
        'totalReports' => $totalReports,
        'pendingReportsCount' => $pendingReportsCount,
        'pendingAppointmentsCount' => $pendingAppointmentsCount,
        'lineChartData' => $formattedLineChartDataJson,
    ]);
}


    function book_appointment(){
        $doctor = Doctor::all();
    return view('userdashboard.book_appointment', compact('doctor'));
    }

   
    public function upload_appoint(Request $request)
    {   
        $data = new appointment;
    
        $data->name = $request->name;
        $data->father_name = $request->fname;
        $data->cnic_no = $request->cnic_no;
        $data->email = $request->email;
        $data->phone = $request->number;
        $data->doctor = $request->doctor;
        $data->date = $request->date;
        $data->message = $request->message;
        $data->status = 'in progress';
    
        // Set 'Is_Deleted' and 'Is_Completed' to 0
        $data->Is_Deleted = 0;
        $data->Is_Completed = 0;
    
        $matchingDoctor = Doctor::where('name', $data->doctor)->first();
    
        if ($matchingDoctor) {
            // If a matching doctor is found, set 'doctor_id' to the matching doctor's ID.
            $data->doctor_id = $matchingDoctor->id;
        }
    
        if (Auth::id()) {  
            $data->patient_id = Auth::user()->id;
        }
    
        $data->save(); 
    
        return redirect()->back()->with('message', 'Appointment Request Successful. We will contact you soon');
    }
    
    function view_appointment()
    {
        if(Auth::id())
        {
            $userid=Auth::user()->id;
            $appoint=appointment::where('patient_id', $userid)->get();
            return view('userdashboard.view_appointment',compact('appoint'));
        }    
        else
        {
            return redirect()->back();
        }
    }

    function view_reports()
{
    if (Auth::id()) 
    {
       
        $userId = Auth::user()->id;
        $report = Report::where('patient_id', $userId)->get();
        return view('userdashboard.reports', compact('report'));
    } 
    else 
    {
        
        return redirect()->back();
    }
}

    public function download(Report $report)
    {
        $filePath = storage_path('app/public/' . $report->file);
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
    
        return redirect()->back()->with('error', 'File not found.');
    }
    public function viewInProgressAppointments()
    {
        // Retrieve "In Progress Appointments"
        $inProgressAppointments = Appointment::where('status', 'in progress')->get();
    
        // Pass the data to the view
        return view('userdashboard.view_appointment', ['appoint' => $inProgressAppointments]);
    }



    function prescription(){
        return view('userdashboard.prescription');
    }

    

    
}




