<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Global_;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function afficher(){
        if(Auth::user()->role =="admin"){
           
    $inscrits=DB::table('users')->select('*')->join('filiere_user','filiere_user.user_id','=','users.id')->get();
            
            return view('second-view/candidat/liste_des_inscrits',compact('inscrits'));
        }
        else{
            return  redirect('dashboard');
        }
    }
}
