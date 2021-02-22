<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function edit()
    {
        return view('auth.edit',['user'=>Auth::user()]);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required|max:255',
            'email' => "required|email|unique:users,email,{$id}",
            'birthday' => 'date|nullable',
            'password' => 'string|min:8|confirmed|nullable',
        ]);
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'birthday' => $request->birthday,
        ]);
        if($request->password){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }
        return redirect()->route('gallery');
    }
}
