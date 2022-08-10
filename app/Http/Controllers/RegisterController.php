<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $user = User::create($attributes);

        $details =[
            'title' =>'Bienvenue cher utilisateur',
            'body' => 'Nous vous informons que votre compte a été créé avec succès'
        ];
        Mail::to(request()->email)->send(new Email($details));

        Auth::login($user);
        return redirect('/dashboard');
    }
}
