<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Filiere;


class HomeController extends Controller
{
    public function home()
    {

        return redirect('dashboard');
    }

    public function select_filiere(){
        if(Auth::user()->role =="admin"){
            //$data =DB::table('users')->where('role','normal user')->get();
            $data_filiere =Filiere::all();
            
            return view('laravel-examples/user-management',compact('data_filiere'));
        }
        else{
            return  redirect('dashboard');
        }
    }


    public function showCandidats(Request $request){
            if(Auth::user()->role =="admin"){
    
                $data=DB::table('users')->select('users.*')->join('filiere_user','filiere_user.user_id','=','users.id')
                ->join('filieres','filieres.id','=','filiere_user.filiere_id')->where('filieres.id',$request->id)->get();
                 
    return response()->json($data);

                      }else{

            return  redirect('dashboard');
                 }
      }



    public function dashboard(){
        if(Auth::user()->role =="normal user"){
                    $user_id = Auth::user()->id;
        return view('dashboard',compact('user_id'));
        }
        else{

            $nombre_filieres = DB::table('filieres')->count();
            $nombre_candidats_inscrits=DB::table('users')->join('filiere_user','filiere_user.user_id','=','users.id')->count();
            //echo($nombre_candidats_inscrits);
            //echo($nombre_filieres);
            return view('statistique',compact('nombre_filieres','nombre_candidats_inscrits'));
        }

    }

    public function verification($id){
        $user_id = Auth::user()->id;
        $user_data = DB::table('users')->where('id',$user_id)->get();
        $user_bac_name  = DB::table('bacs')->selectRaw('bacs.id,bacs.name')->join('bac_user','bac_user.bac_id','=','bacs.id')->join('users','users.id','=','bac_user.user_id')->where('users.id',$user_id)->get();
        return response()->json(['data' => $user_bac_name,
                                 'user_data' => $user_data,
                                ]);
    }

    public function verification_recu(){
        $user_id = Auth::user()->id;
        $user_data = DB::table('users')->where('id',$user_id)->get();
        return response()->json([
            'user_data' => $user_data,
        ]);

    }
}
