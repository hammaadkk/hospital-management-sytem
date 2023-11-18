<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor; 

use App\Models\Appointment;





use Notification;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
   


    public function addview()
    {

        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
             
            {
                return view('admin.add_doctor');
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect('login');
        }


       
    }
// upload doctor
    public function upload(Request $request)
    {
        $doctor = new doctor;
        $image=$request->file;
        $imagename=time().'.'.$image->getClientoriginalExtension();
        $request->file->move('doctorimage',$imagename);
        $doctor->image=$imagename;
        $doctor->name=$request->name;
        $doctor->phone=$request->number;
        $doctor->room=$request->room;
        $doctor->speciality=$request->speciality;
        $doctor->save();
        
        return redirect()->back()->with('message', 'Doctor added successfully...');
    }
// showappointment
    public function showappointment()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
             
            {

        $data=appointment::all();

        return view('admin.showappointment', compact('data'));
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect('login');
        }
    }

    public function approved($id)
    {

        $data=appointment::find($id);
        $data->status='approved';
        $data->save();
        return redirect()->back();
    }

    public function Cancelled($id)
    {

        $data=appointment::find($id);
        $data->status='Cancelled';
        $data->save();
        return redirect()->back();
    }
// showdoctor
public function showdoctor()
{
    $data = Doctor::where('Is_Deleted', 0)->get();
    return view('admin.showdoctor', compact('data'));
}


// deletedoctor 
public function deletedoctor($id)
{
    $data = Doctor::find($id);

    if ($data) {
        $data->Is_Deleted = 1;
        $data->save();
    }

    return redirect()->back();
}

// updatedoctor
    public function updatedoctor($id)
    {

        $data=doctor::find($id);

        return view('admin.update_doctor',compact('data'));

    }
// editdoctor
    public function editdoctor(Request $request, $id)
    {
        $doctor= doctor::find($id);
        $doctor->name=$request->name;
        $doctor->phone=$request->number;
        $doctor->speciality=$request->speciality;
        $doctor->room=$request->room;
        $image=$request->file;

        if($image)
        {
        $imagename=time().".".$image->getClientOriginalExtension();
        $request->file->move('doctorimage', $imagename);

        $doctor->image=$imagename;
        }

        $doctor->save();

        return redirect()->back()->with('message','Doctors details updated successfully.....');
    }
// emailview
    public function emailview($id)
    {
        $data=appointment::find($id);
        return view('admin.email_view',compact('data'));
    }

    public function sendemail(Request $request, $id)
    {
        $data = appointment::find($id);

        $details=[

            'greeting'=> $request->greeting,

            'body' => $request->body,

            'actiontext' => $request->actiontext,

            'actionurl' => $request->actionurl,

            'endpart' => $request->endpart

        ];

        Notification::send($data,new SendEmailNotification($details));

        return redirect()->back()->with('message','Email send is successful.....');
    }













}
