<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labassistant;
use Validator, Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\Test;


class LabassistantController extends Controller
{
    
    public function authenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
            
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'Is_Deleted' => 0,
        ];

        if (Auth::guard('labassistant')->attempt($credentials, $request->get('remember'))) {
            return redirect()->route('labassistant.dashboard');
        } else {
            session()->flash('error', 'Either email or password is incorrect, or your account is not active.');
            return back()->withInput($request->only('email'));
        }
    }

    
    // labassistant
// add_labassistants
function add_labassistants()
{
    return view('admin.add_labassistants');
}
// uploadlabassistant
public function uploadlabassistant(Request $request){
    $labassistant = new labassistant;
    $image=$request->file;
    $imagename=time().'.'.$image->getClientoriginalExtension();
    $request->file->move('labassistantimage',$imagename);
    $labassistant->photo=$imagename;
    $labassistant->name=$request->name;
    $labassistant->email=$request->email;
    $labassistant->address=$request->address;
    $labassistant->gender=$request->gender;
    $labassistant->dob=$request->dob;
    $labassistant->employee_id=$request->emid;
    $labassistant->shift=$request->shift;
    $labassistant->job_start_date=$request->jobstart;
    $labassistant->qualification=$request->education;
    $labassistant->experience=$request->experience;
    $labassistant->password = bcrypt($request->pass);
    $labassistant->save();
    
    return redirect()->back()->with('message', 'labassistant added successfully...');
}
// showlabassistant
public function showlabassistant(){

    $data = labassistant::where('Is_Deleted', 0)->get();
    return view('admin.showlabassistant',compact('data'));
}
// deletelabassistant
public function deletelabassistant($id){

    $data =labassistant::find($id);
    $data->delete();

    return redirect()->back();

}
// updatelabassistant
public function updatelabassistant($id){

    $data=labassistant::find($id);

    return view('admin.update_labassistant',compact('data'));

}
// editlabassistant
public function editlabassistant(Request $request, $id)
{
    $labassistant = labassistant::find($id);

    $labassistant->name = $request->name;
    $labassistant->email = $request->email;
    $labassistant->address = $request->address;
    $labassistant->gender = $request->gender;
    $labassistant->dob = $request->dob;
    $labassistant->employee_id = $request->emid;
    $labassistant->shift = $request->shift;
    $labassistant->job_start_date = $request->jobstart;
    $labassistant->qualification = $request->education;
    $labassistant->experience = $request->experience;
    $labassistant->password = $request->pass;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('labassistantimage', $imageName);
        $labassistant->image = $imageName;
    }

    $nurse->save();

    return redirect()->back()->with('message', 'labassistant details updated successfully.');
}

public function add_test(){

    return view('labassistant.add_test');
}
public function upload_report(){
    
   
    $reports = Report::all();
   
    return view('labassistant.upload_report', compact('reports'));
}

public function add_report(){
    $doctor = Doctor::all();
    $patients = appointment::all();
    return view('labassistant.add_report', compact('doctor','patients'));
}



    public function showreports()
    {
        $reports = Reports::all();

        return view('labassistant.upload_report', compact('reports'));
    }
 
    
    public function upload(Request $request)
    {
        $file = $request->file('file');
    
        if ($file) {
            $fileName = $file->getClientOriginalName(); // Get the original file name
            $path = $file->storeAs('public/reports', $fileName); // Save the file in the public/reports directory
            $report = Report::find($request->input('report_id'));
            $report->file = $path;
            $report->status = 'Uploaded';
            $report->save();
            return redirect()->back()->with('message', 'Report added successfully.');
        }
    
        return redirect()->back()->with('error', 'Please upload a file.');
    }
    

    public function download(Report $report)
{
    $filePath = storage_path('app/public/' . $report->file);

    if (file_exists($filePath)) {
        return response()->download($filePath);
    }

    return redirect()->back()->with('error', 'File not found.');
}



public function upload_reportfile(Request $request)
{
    $report = new Report;


    $report->patient_id = $request->pid;
    $report->patient_name = $request->patient_name;
    $report->doctor = $request->doctor;
    $report->appointment_date = $request->date;
    $report->test_names = $request->test_name;

    $report->status = 'in process';
    $report->save();

    return redirect()->back()->with('message', 'Report added Successfully.');
}

public function searchPatients(Request $request)
{
if ($request->ajax()) {
    $data = Appointment::where('name', 'LIKE', $request->name . '%')->get();
    $output = '';
    if (count($data) > 0) {
        $output = '<ul class="list-group" style="display:block;position:relative;z-index:1;">';
        foreach ($data as $row) {
            $output .= '<li class="list-group-item">' . $row->name . '</li>';
        }
        $output .= '</ul>';
    } else {
        $output .= '<li class="list-group-item">No data Found</li>';
    }
    return $output; // Return the generated HTML response
}
}


public function searchPatientsid(Request $request)
{
if ($request->ajax()) {
    $data = Appointment::where('patient_id', 'LIKE', $request->patient_id . '%')->get();
    $output = '';
    if (count($data) > 0) {
        $output = '<ul class="list-group" style="display:block;position:relative;z-index:1;">';
        foreach ($data as $row) {
            $output .= '<li class="list-group-item">' . $row->patient_id . '</li>'; // Fetch data from the 'patient_id' column
        }
        $output .= '</ul>';
    } else {
        $output .= '<li class="list-group-item">No data Found</li>';
    }
    return $output; // Return the generated HTML response
}
}





public function searchTests(Request $request)
{
    if ($request->ajax()) {
        $data = Test::where('test_name', 'LIKE', $request->test_name . '%')->get();
        $output = '';
        if (count($data) > 0) {
            $output = '<ul class="list-group" style="display:block;position:relative;z-index:1;">';
            foreach ($data as $row) {
                $output .= '<li class="list-group-item">' . $row->test_name . '</li>';
            }
            $output .= '</ul>';
        } else {
            $output .= '<li class="list-group-item">No data Found</li>';
        }
        return $output; // Return the generated HTML response
    }
}



public function getPatientName(Request $request)
    {
        if($request->ajax()) {
	$patientName = $request->input('patient_id');
	$patient = Appointment::where('patient_id',$patientName )->first();
	
	if($patient) {
	   return response()->json($patient->name);
	} else{
	   return response()->json('Patient not found.',404);
	}
    }
}

public function getDoctorInfo(Request $request)
    {
        $patientId = $request->input('patient_id');

        // Assuming 'appointments' is the name of your appointments table
        $appointment = Appointment::where('patient_id', $patientId)->first();

        if ($appointment) {
            return response()->json([
                'doctor' => $appointment->doctor,
                'appointment_date' => $appointment->date,
            ]);
        }

        return response()->json(['error' => 'Appointment not found'], 404);
    }

    public function searchtestname(Request $request){
        if($request->ajax()){
            $data = Test::where('test_name', 'LIKE', $request->test_name . '%')->get();
            $output = '';
            if(count($data) > 0){
                $output = '<ul class="list-group" style="display:block;">'; // Remove unnecessary styling
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">' . $row->test_name . '</li>'; // Use 'test_name' column
                }
                $output .= '</ul>';
            }
            else{
                $output .= '<li class="list-group-item">No Data Found</li>';
            }
            return $output;
        }
    }

    public function fetchTestCharges(Request $request){
        if ($request->ajax()) {
            $testName = $request->test_name;
            $test = Test::where('test_name', $testName)->first();
            
            if ($test) {
                return $test->charges;
            } else {
                return "N/A";
            }
        }
    }
    

    public function view_all_tests(){
        $data = Test::all();
    return view('labassistant.view_all_tests',compact('data'));
}
public function edit($id)
{
    $test = Test::findOrFail($id); // Assuming you have a Test model
    // Return your edit view or perform edit logic
}

public function destroy($id)
{
    $test = Test::findOrFail($id);
    $test->delete();
    return response()->json(['message' => 'Record deleted successfully']);
}
public function update(Request $request, $id)
{
    // Validate the input fields if necessary
    
    $test = Test::findOrFail($id);
    $test->test_name = $request->input('test_name');
    $test->charges = $request->input('charges');
    $test->save();
    
    return response()->json(['message' => 'Record updated successfully']);
}

public function add(Request $request)
{
    $test = new Test;

    $test->test_name = $request->newTestName;
    $test->charges = $request->newCharges;
    
    $test->save();
    
    return redirect()->back()->with('message', 'Record added successfully');
}


    
    
}