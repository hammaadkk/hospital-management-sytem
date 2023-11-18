<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receptionist;
use App\Models\Appointment;
use App\Models\General_ward;
use App\Models\Booked_bed;
use App\Models\Booked_room;
use App\Models\BookedRoom;
use App\Models\Doctor;
use App\Models\Room;
use App\Models\Checkin;
use App\Models\Report;
use App\Models\Test;
use App\Models\Doctor_fees;
use Validator, Auth;
use Illuminate\Validation\Rule;


class ReceptionistController extends Controller
{
    
    public function dashboard()
    {
        $countAppointments = Appointment::count();
        $countInProgressAppointments = Appointment::where('status', 'in progress')->count();
        $countCancelledAppointments = Appointment::where('status', 'Cancelled')->count();
        return view('receptionist.dashboard', compact('countAppointments','countInProgressAppointments', 'countCancelledAppointments'));
    }



    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'Is_Deleted' => 0,
        ];
    
        if (Auth::guard('receptionist')->attempt($credentials, $request->get('remember'))) {
            // Retrieve the authenticated receptionist
            $receptionist = Auth::guard('receptionist')->user();
    
            // Set the receptionist data in the session
            session(['receptionist' => $receptionist]);
    
            // Redirect to the receptionist dashboard
            return redirect()->route('receptionist.dashboard');
        } else {
            session()->flash('error', 'Either email or password is incorrect, or your account is not active.');
            return back()->withInput($request->only('email'));
        }
    }
    
    public function logout()
    {
        Auth::guard('receptionist')->logout();
        return redirect()->route('receptionist.login');
    }
    // receptionist

function add_receptionists()
{
    return view('admin.add_receptionists');
}
// uploadreceptionist
public function uploadreceptionist(Request $request){
    $receptionist = new receptionist;
    $image=$request->file;
    $imagename=time().'.'.$image->getClientoriginalExtension();
    $request->file->move('receptionistimage',$imagename);
    $receptionist->photo=$imagename;
    $receptionist->name=$request->name;
    $receptionist->email=$request->email;
    $receptionist->address=$request->address;
    $receptionist->gender=$request->gender;
    $receptionist->dob=$request->dob;
    $receptionist->employee_id=$request->emid;
    $receptionist->shift=$request->shift;
    $receptionist->job_start_date=$request->jobstart;
    $receptionist->qualification=$request->education;
    $receptionist->experience=$request->experience;
    $receptionist->password = bcrypt($request->pass);
    $receptionist->save();
    
    return redirect()->back()->with('message', 'receptionist added successfully...');
}
// showreceptionist
public function showreceptionist(){

    $data = receptionist::where('Is_Deleted', 0)->get();
    return view('admin.showreceptionist',compact('data'));
}
// deletereceptionist
public function deletereceptionist($id){

    $data =receptionist::find($id);
    if ($data) {
        $data->Is_Deleted = 1;
        $data->save();
    }
    return redirect()->back();

}
// updatereceptionist
public function updatereceptionist($id){

    $data=receptionist::find($id);

    return view('admin.update_receptionist',compact('data'));

}
// editreceptionist
public function editreceptionist(Request $request, $id)
{
    $receptionist = receptionist::find($id);

    $receptionist->name = $request->name;
    $receptionist->email = $request->email;
    $receptionist->address = $request->address;
    $receptionist->gender = $request->gender;
    $receptionist->dob = $request->dob;
    $receptionist->employee_id = $request->emid;
    $receptionist->shift = $request->shift;
    $receptionist->job_start_date = $request->jobstart;
    $receptionist->qualification = $request->education;
    $receptionist->experience = $request->experience;
    $receptionist->password = $request->pass;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('receptionistimage', $imageName);
        $receptionist->image = $imageName;
    }

    $receptionist->save();

    return redirect()->back()->with('message', 'receptionist details updated successfully.');
}

function book(){
    $doctor = Doctor::all();
    return view('receptionist.book', compact('doctor'));
}

function showappointments() {
    $data = Appointment::where('is_deleted', 0)->get();
    return view('receptionist.showappointments', compact('data'));
}

// book_bed
function book_bed(){
    $ward = General_ward::all();
    return view('receptionist.book_bed', compact('ward'));
}
// upload_bed
public function upload_bed(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'name' => 'required',
        'age' => 'required',
        'ward' => 'required',
        'bed_no' => 'required',
        'date' => 'required',
    ]);

    // Create a new instance of the BookedBed model
    $bed  = new Booked_bed();

    // Assign the form data to the model attributes
    $bed->patient_name = $request->input('name');
    $bed->age = $request->input('age');
    $bed->patient_cnic = $request->input('cnic');
    $bed->guardian_name = $request->input('guardian_name');
    $bed->guardian_cnic = $request->input('guardian_cnic');
    $bed->ward_name = $request->input('ward');
    $bed->bed_no = $request->input('bed_no');
    $bed->date = $request->input('date');
    $bed->time = $request->input('time');

    // Save the booked bed data to the database
    $bed->save();

    // Redirect the user back with a success message
    return redirect()->back()->with('message', 'Bed booked successfully!');
}

// check available beds
public function availableBeds(Request $request)
{
    $wardName = $request->input('wardName');

    // Retrieve the booked beds for the selected ward
    $bookedBeds = Booked_bed::where('ward_name', $wardName)->pluck('bed_no')->toArray();

    // Retrieve the capacity of the ward
    $capacity = General_ward::where('name', $wardName)->value('capacity');

    return response()->json([
        'bookedBeds' => $bookedBeds,
        'capacity' => $capacity,
    ]);
}
// check patient cnic
public function checkCnicAvailability(Request $request)
{
    $cnic = $request->input('cnic');

    // Check if CNIC exists in booked_beds table
    $exists = Booked_bed::where('patient_cnic', $cnic)->exists();

    return response()->json([
        'available' => !$exists,
    ]);
}

public function fetchName(Request $request)
{
    $userId = $request->input('userId');
    $appointment = Appointment::where('user_id', $userId)->first();
    $name = $appointment ? $appointment->name : '';

    return response()->json(['name' => $name]);
}


// book_room
function book_room(){
    $room = Room::all();
    return view('receptionist.book_room', compact('room'));
}

function upload_appointment(Request $request){
        
    $appoint = new appointment;  
    $appoint->name=$request->name;
    $appoint->father_name=$request->fname;
    $appoint->cnic_no=$request->cnic_no;  
    $appoint->email=$request->email;
    $appoint->phone=$request->number; 
    $appoint->doctor=$request->doctor;
    $appoint->date=$request->date; 
    $appoint->message=$request->message;     
    $appoint->status='in progress';
    $matchingDoctor = Doctor::where('name', $appoint->doctor)->first();

    if ($matchingDoctor) {
        // If a matching doctor is found, set 'doctor_id' to the matching doctor's ID.
        $appoint->doctor_id = $matchingDoctor->id;
    }
    if(Auth::id())
    {  
    $appoint->user_id = Auth::user()->id;
    }
    $appoint->save(); 
    return redirect()->back()->with('message', 'Appointment Request Successfull. We will contact you soon');
}


public function receptionistDashboard()
{
    $countAppointments = Appointment::count();
    return view('receptionist.receptionist_dashboard', compact('countAppointments'));
}
public function checkin()
{
    return view('receptionist.checkin');
}

public function searchpatientname(Request $request)
{
    if($request->ajax()){
        $data = Appointment::where('name', 'LIKE', $request->name . '%')->get();
        $output = '';
        if(count($data) > 0){
            $output = '<ul class="list-group" style="display:block;">'; // Remove unnecessary styling
            foreach ($data as $row) {
                $output .= '<li class="list-group-item">' . $row->name . '</li>'; // Use 'test_name' column
            }
            $output .= '</ul>';
        }
        else{
            $output .= '<li class="list-group-item">No Data Found</li>';
        }
        return $output;
    }
}

public function uploadcheckin(Request $request)
{
    $checkin = new checkin;  
    
    $appoint->save(); 
    return redirect()->back()->with('message', 'Appointment Request Successfull. We will contact you soon');
}

public function updateStatus(Request $request)
{
    Log::info('Update status request received.');
    Log::info('Request data:', $request->all());
    $request->validate([
        'patientId' => 'required|integer',
        'newStatus' => 'required|in:Visited',
    ]);

    $appointment = Appointment::where('patient_id', $request->patientId)->firstOrFail();
    $appointment->status = $request->newStatus;
    $appointment->save();

    return response()->json(['success' => true]);
}

public function searchcnic(Request $request)
{
    if ($request->ajax()) {
        $data = Appointment::where('status', 'approved')
            ->where('cnic_no', 'LIKE', $request->cnic_no . '%')
            ->get();

        $output = '';
        if (count($data) > 0) {
            $output = '<ul class="list-group" style="display:block;position:relative;z-index:1;">';
            foreach ($data as $row) {
                $output .= '<li class="list-group-item">' . $row->cnic_no . '</li>';
            }
            $output .= '</ul>';
        } else {
            $output .= '<li class="list-group-item">No data Found</li>';
        }
        return $output;
    }
}


    public function storeCheckin(Request $request)
{
    $cnicNo = $request->input('cnic_no');
    
   
    $appointment = Appointment::where('cnic_no', $cnicNo)->first();

    if (!$appointment) {
     
        return redirect()->back()->with('error', 'Appointment not found for the provided CNIC');
    }

   
    $checkin = new Checkin();
    $checkin->appointment_id = $appointment->id;
    $checkin->cnic_no = $cnicNo;
    $checkin->checkin_datetime = now();
    $checkin->save();

   
    return redirect()->back()->with('message', 'Checkin added successfully...');
}
public function showPaymentForm()
{
    $appointments = []; // You can initialize these as empty arrays or with some default values
    $reports = [];

    return view('receptionist.payment', compact('appointments', 'reports'));
}

public function payment(Request $request)
{
    $searchTerm = $request->input('patient_id'); 

    $appointments = Appointment::where(function ($query) use ($searchTerm) {
        $query->where('id', $searchTerm)
            ->orWhere('patient_id', $searchTerm);
    })
    ->where('status', 'approved')
    ->where('Is_Deleted', 0)
    ->where('Is_Completed', 0)
    ->get();

    $totalAppointmentCharges = 0; // Initialize total appointment charges

    foreach ($appointments as $appointment) {
        $doctorId = $appointment->doctor_id;
        $doctorFee = Doctor_Fees::where('doctor_id', $doctorId)->first();

        if ($doctorFee) {
            $appointment->charges = $doctorFee->fee_amount;
            $totalAppointmentCharges += $doctorFee->fee_amount; 
        }
    }

    $reports = Report::where('patient_id', $searchTerm)
        ->where('Is_Deleted', 0)
        ->where('Is_Paid', 0)
        ->get();

    $totalReportCharges = 0; // Initialize total report charges

    foreach ($reports as $report) {
        $testId = $report->test_id;
        $test = Test::find($testId);

        if ($test) {
            $report->charges = $test->charges;
            $totalReportCharges += $test->charges; // Update total report charges
        }
    }

    $totalCharges = $totalAppointmentCharges + $totalReportCharges; // Calculate total charges

    return view('receptionist.payment', [
        'appointments' => $appointments,
        'reports' => $reports,
        'totalAppointmentCharges' => $totalAppointmentCharges,
        'totalReportCharges' => $totalReportCharges,
        'totalCharges' => $totalCharges,
    ]);
}






}