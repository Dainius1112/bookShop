<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.login.main');
    }
    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password],$request->remember)){
            return back()->with('status','Invalid login details');
        }

        return redirect()->route('home');
    }
    
}
