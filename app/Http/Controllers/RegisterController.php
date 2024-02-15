<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes=request()->validate([
        'name'=>'required|max:255',
        'user_name'=>['required','max:255','min:3','unique:users,user_name'],
        'email'=>['required','unique:users,email','max:255'],
        'password'=>['required','max:255','min:7']
        ]);
        $user=User::create($attributes);
        auth()->login($user);
        return redirect('/')->with('success','Your account has been created.');
    }
}
