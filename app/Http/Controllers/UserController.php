<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | min:1 | max:32',
            'email' => 'required | email | max:64 | unique:users',
            'password' => 'required | min:6 | max:64',
            'confirm-password' => 'required | same:password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('posts.index')->with('success','Registration Successful, Please Log in.');
    }
}
