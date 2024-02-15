<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function create()
    {
        return view('session.login');

    }
    public function store()
    {
        $attributes=\request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if (auth()->attempt($attributes)){
            session()->regenerate();

            return redirect('/')->with('success','You are Logged In!');
        }

        return back()
            ->withInput()
            ->withErrors(['email'=>'Your Provided Credentials could not be verified.']);
    }
    public function destroy()
    {
        auth()->logout();

       return redirect('/')->with('success','GoodBye!');
    }
}
