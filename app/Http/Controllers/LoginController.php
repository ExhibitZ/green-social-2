<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required | email | max:64',
            'password' => 'required | min:6 | max:64',
        ]);
        
        if (Auth::attempt($request->only('email','password')))
        {
            return redirect()->route('posts.index');
        }
        else
        {
            return back()->with('error','Invalid email or password');
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->back();
    }
}
