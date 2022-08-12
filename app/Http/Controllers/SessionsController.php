<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.Accueil');
    }

    public function store(Request $request)
    {
        // $attributes = request()->validate([
        //     'email'=>'required|email',
        //     'password'=>'required' ,
        //     'state'=>"1"
            
        // ]);

        $email=$request->email;
        $password=$request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'state' => 1]))
        {
            session()->regenerate();
            if(Auth::user()->role =="professeur"){
                return redirect('candidats')->with(['success'=>'You are logged in.']);
            }elseif(Auth::user()->role =="super admin"){
                   return redirect('utilisateurs');
            }else{
                return redirect('dashboard')->with(['success'=>'You are logged in.']);
            }
            
        }
        elseif(Auth::attempt(['email' => $email, 'password' => $password])){
                return back()->withErrors(['email'=>'Votre compte est désactivé']);
        }else{
            return back()->withErrors(['email'=>'Email or password invalid.']);

        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/Accueil')->with(['success'=>'You\'ve been logged out.']);
    }
}
