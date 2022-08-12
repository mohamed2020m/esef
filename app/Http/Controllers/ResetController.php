<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ResetController extends Controller
{
    public function create()
    {
        return view('session/reset-password/sendEmail');

    }

    public function sendEmail(Request $request)
    {
        if(env('IS_DEMO'))
        {
            return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t recover your password.']);
        }
        else{
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);

            $token = Str::random(60);

            DB::table('password_resets')->insert(
                ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
            );

            Mail::send('components.verify',['token' => $token], function($message) use ($request) {
                      $message->from("contact@esefj.ma",'ESEFJ');
                      $message->to($request->email);
                      $message->subject('Demande de réinitialisation du mot de passe');
                   });

            return redirect('/Accueil')->with('success', 'Nous avons envoyé un lien de réinitialisation de mot de passe par e-mail !');
        }
        }


    public function resetPass($token)
    {
        return view('session/reset-password/resetPassword', ['token' => $token]);
    }
}
