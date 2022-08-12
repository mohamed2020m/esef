<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' =>'required',
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );



        session()->flash('success', 'Your account has been created.');
        $user = User::create([
            'email' => request()->email,
            'password' => bcrypt(request()->password),
            'code' => Str::random(60),
        ]);
        Mail::to(request()->email)->send(new Email($user));

        //Auth::login($user);
        return redirect('/dashboard');
    }
}
