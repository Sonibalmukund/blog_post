<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function edit(User $user)
    {
        return view('register.edit', ['user' => $user]);

    }

    public function update(User $user)
    {
//        dd('hii');
        $attributes=request()->validate([
            'name'=>'required|max:255',
            'user_name'=>['required','max:255','min:3'],
            'email'=>['required','max:255'],
            'password'=>['nullable','max:255','min:7'],
            'avatar'=>['nullable','image']
        ]);
        if(isset($attributes['avatar'])){
            $avatar = \request()->file('avatar');
            $thumbnailPath = $avatar->storeAs('public/avatars', $avatar->getClientOriginalName());
            $attributes['avatar'] = str_replace('public/', '', $thumbnailPath);
        }
        $user = auth()->user();

        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }
//        dd($attributes);
        $user->update($attributes);

        return back()->with('success','Your account has been Updated.');

    }

}
