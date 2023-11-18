<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nurse; 
use Validator, Auth;


class NurseController extends Controller
{
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
    
        if (Auth::guard('nurse')->attempt($credentials, $request->get('remember'))) {
            // Retrieve the authenticated nurse
            $nurse = Auth::guard('nurse')->user();
    
            // Set the nurse data in the session
            session(['nurse' => $nurse]);
    
            return redirect()->route('nurse.dashboard');
        } else {
            session()->flash('error', 'Either email or password is incorrect, or your account is not active.');
            return back()->withInput($request->only('email'));
        }
    }
    
    // add_nurses
    function add_nurses()
    {
        return view('admin.add_nurses');
    }
// uploadnurse
    public function uploadnurse(Request $request){
        $nurse = new nurse;
        $image=$request->file;
        $imagename=time().'.'.$image->getClientoriginalExtension();
        $request->file->move('nurseimage',$imagename);
        $nurse->photo=$imagename;
        $nurse->name=$request->name;
        $nurse->email=$request->email;
        $nurse->address=$request->address;
        $nurse->gender=$request->gender;
        $nurse->dob=$request->dob;
        $nurse->employee_id=$request->emid;
        $nurse->shift=$request->shift;
        $nurse->job_start_date=$request->jobstart;
        $nurse->qualification=$request->education;
        $nurse->experience=$request->experience;
        $nurse->password = bcrypt($request->pass);
        $nurse->save();
        
        return redirect()->back()->with('message', 'Nurse added successfully...');
    }
// shownurse
    public function shownurse(){

        $data = nurse::where('Is_Deleted', 0)->get();
        return view('admin.shownurse',compact('data'));
    }
//  deletenurse
    public function deletenurse($id){

        $data =nurse::find($id);
        if ($data) {
            $data->Is_Deleted = 1;
            $data->save();
        }
        return redirect()->back();

    }
// updatenurse
    public function updatenurse($id){

        $data=nurse::find($id);

        return view('admin.update_nurse',compact('data'));

    }
// editnurse
    public function editnurse(Request $request, $id)
    {
        $nurse = nurse::find($id);
    
        $nurse->name = $request->name;
        $nurse->email = $request->email;
        $nurse->address = $request->address;
        $nurse->gender = $request->gender;
        $nurse->dob = $request->dob;
        $nurse->employee_id = $request->emid;
        $nurse->shift = $request->shift;
        $nurse->job_start_date = $request->jobstart;
        $nurse->qualification = $request->education;
        $nurse->experience = $request->experience;
        $nurse->password = $request->pass;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('nurseimage', $imageName);
            $nurse->image = $imageName;
        }
    
        $nurse->save();
    
        return redirect()->back()->with('message', 'Nurse details updated successfully.');
    }

}
