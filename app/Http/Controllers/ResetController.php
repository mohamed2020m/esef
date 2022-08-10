<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;

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
                      $message->from("contact@esefj.ma");
                      $message->to($request->email);
                      $message->subject('réinitialiser le mot de passe');
                   });

            return back()->with('message', 'Nous avons envoyé votre lien de réinitialisation de mot de passe par e-mail !');
        }
        }
    

    public function resetPass($token)
    {
        return view('session/reset-password/resetPassword', ['token' => $token]);
    }
}
