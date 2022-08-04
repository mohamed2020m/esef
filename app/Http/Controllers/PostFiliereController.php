<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Set;

class PostFiliereController extends Controller
{
    public function index(){
        if(Auth::user()->role =="normal user"){
            $user_id = Auth::user()->id;
            $bac_of_user = DB::table('bacs')->selectRaw('bacs.id,bacs.name')->join('bac_user','bac_user.bac_id','=','bacs.id')->join('users','users.id','=','bac_user.user_id')->where('users.id',$user_id)->get();
            $licence_of_user = DB::table('licences')->selectRaw('licences.id,licences.name')->join('licence_user','licence_user.licence_id','=','licences.id')->join('users','users.id','=','licence_user.user_id')->where('users.id',$user_id)->get();


            $choix_filiere_with_bac = DB::table('filieres')->selectRaw('filieres.id,filieres.name')->join('bac_filiere','bac_filiere.filiere_id','=','filieres.id')->join('bacs','bacs.id','=','bac_filiere.bac_id')->where('bacs.id',$bac_of_user[0]->id)->get();
            $choix_filiere_with_licence = DB::table('filieres')->selectRaw('filieres.id,filieres.name')->join('filiere_licence','filiere_licence.filiere_id','=','filieres.id')->join('licences','licences.id','=','filiere_licence.licence_id')->where('licences.id',$licence_of_user[0]->id)->get();
            $filiere_possible = $choix_filiere_with_licence->intersectByKeys($choix_filiere_with_bac);

            $user_with_filiere = DB::table('filieres')->selectRaw('filieres.id,filieres.name')->join('filiere_user','filiere_user.filiere_id','=','filieres.id')->join('users','users.id','=','filiere_user.user_id')->where('users.id',$user_id)->get();

            $filiere_possible =DB::table('filieres')->selectRaw('filieres.id,filieres.name')
                                ->join('filiere_licence','filiere_licence.filiere_id','=','filieres.id')
                                ->join('licences','licences.id','=','filiere_licence.licence_id')
                                ->where('licences.id',$licence_of_user[0]->id)
                                ->whereNotIn('filieres.id', DB::table('filieres')->select('filieres.id')
                                ->join('filiere_user','filiere_user.filiere_id','=','filieres.id')
                                ->join('users','users.id','=','filiere_user.user_id')
                                ->where('users.id',$user_id))->get()

                            ->intersectByKeys(

                                DB::table('filieres')->selectRaw('filieres.id,filieres.name')
                                ->join('bac_filiere','bac_filiere.filiere_id','=','filieres.id')
                                ->join('bacs','bacs.id','=','bac_filiere.bac_id')->where('bacs.id',$bac_of_user[0]->id)
                                ->whereNotIn('filieres.id', DB::table('filieres')->select('filieres.id')
                                ->join('filiere_user','filiere_user.filiere_id','=','filieres.id')
                                ->join('users','users.id','=','filiere_user.user_id')
                                ->where('users.id',$user_id))->get()
                            );


        $x = $filiere_possible;
            return view('liste-filiere-possible/index',compact('x','user_with_filiere'));
        }
        else{
            return redirect('dashboard');
        }
    }

    public function matieres($id){
        $liste_matieres = DB::table('matieres')->selectRaw('matieres.id,matieres.name')->join('filiere_matiere','filiere_matiere.matiere_id','=','matieres.id')->join('filieres','filieres.id','=','filiere_matiere.filiere_id')->where('filieres.id',$id)->get();
        return response()->json([
            'matieres' => $liste_matieres,
            'filiere_id' => $id,
        ]);
    }
}
