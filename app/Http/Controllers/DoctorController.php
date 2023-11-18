<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Auth;


class DoctorController extends Controller
{
    public function authenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('doctor')->attempt(['email' =>$request->email, 'password' => $request->password], $request->get('remember'))){
            return redirect()->route('doctor.dashboard');
        }
        else{
            session()->flash('error', 'Either email or password is incorrect');
            return back()->withInput($request->only('email'));
        }
    }
}
