<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('login.register.main');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'name' =>$request->name,
            'username' =>$request->username,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
        ]);

        Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        return redirect()->route('home');
    }
}
