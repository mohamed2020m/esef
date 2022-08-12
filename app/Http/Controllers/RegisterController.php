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



        // session()->flash('success', 'Votre compte a été créé avec succès.');
        $user = User::create([
            'email' => request()->email,
            'password' => bcrypt(request()->password),
            'code' => Str::random(60),
        ]);
        Mail::to(request()->email)->send(new Email($user));

        //Auth::login($user);
        return redirect('/Accueil')->with('success','Votre compte a été créé avec succès, nous avons vous envoyé un email pour valider votre compte,veuillez le confirmer');
    }

    public function verify_email($verification_code){
        $user = User::where('code',$verification_code)->first();
        if(!$user){
            return redirect('/Accueil')->with('error','URL n\'est pas valide');
        }
        else{
            if($user->state =="1"){
                return redirect('/Accueil')->with('success','email deja valider');
            }
            else{
                $user->update(['state' => "1",'code' =>null]);
                return redirect('/Accueil')->with('success','E-mail vérifié avec succès');
            }

        }
    }
}
