<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Filiere;
use App\Models\Licence;

class HomeController extends Controller
{
    public function home()
    {

        return redirect('dashboard');
    }

    public function select_filiere(){
        if(Auth::user()->role =="admin"){
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
            ->where('filiere_user.filiere_id',$request->id)->get();

            foreach ($data as $candidat) {
                $total_note_matiere=0;
                $total_coefficient_matiere=0;
                $note_partie_bac=0;
                $note_partie_licence=0;
                $coefficient_bac=0;
                $coefficient_licence=0;
                $cuurent_school_year = date("Y") - 1;
                $year_of_graduation = date("Y") - 1;;

                // $matieres=DB::table('matiere_user')->select('matiere_user.*')
                // ->join('matieres','matieres.id','=','matiere_user.matiere_id')
                // ->where('matiere_user.user_id',$candidat->id)

                $matieres=DB::table('matiere_user')
                ->select(DB::raw('distinct(matiere_user.matiere_id), matiere_user.matiere_id, matiere_user.user_id , matiere_user.note, matieres.name, filiere_matiere.filiere_id'))
                ->join('matieres','matieres.id','=','matiere_user.matiere_id')
                ->join('filiere_matiere','filiere_matiere.matiere_id','=','matiere_user.matiere_id')
                ->where('filiere_matiere.filiere_id', $request->id)
                ->where('matiere_user.user_id',$candidat->id)
                ->get();
                
                foreach($matieres as $matiere){
                    $coefficient=DB::table('filiere_matiere')->select('filiere_matiere.*')
                    ->where('filiere_matiere.filiere_id', $request->id)
                    ->where('filiere_matiere.matiere_id', $matiere->matiere_id)
                    ->first();

                    if($coefficient){
                        $produit_matiere_coefficient = ($matiere->note)*($coefficient->coefficient_matiere);
                        $total_note_matiere += $produit_matiere_coefficient;
                        $total_coefficient_matiere += $coefficient->coefficient_matiere;  
                    }
                }
                //note du partie bac avant l'ajout du bonus
                if ($total_coefficient_matiere){
                    $note_partie_bac = $total_note_matiere/$total_coefficient_matiere;
                }

                // adding Bonus
                $bac=DB::table('bac_filiere')->select('bac_filiere.*')
                ->join('bac_user','bac_user.bac_id','=','bac_filiere.bac_id')
                ->where('bac_filiere.filiere_id',$request->id)
                ->where('bac_user.user_id',$candidat->id)
                ->first();

                if($bac){
                    $note_partie_bac += $bac->bonus_bac;
                    $coefficient_bac = $bac->coefficient_bac;
                }

                $year_of_graduation = DB::table('bac_user')->select('annee_obtention')
                ->where('bac_user.user_id', $candidat->id)
                ->first();

                //NOTE DU PARTIE BAC APRES l'ajout du bonus 
                $licence=DB::table('licence_user')->select('licence_user.*')
                ->join('licences','licences.id','=','licence_user.licence_id')
                ->where('licence_user.user_id',$candidat->id)
                ->first();
                
                if($licence){
                    $note_partie_licence = (($licence->note_s1)+($licence->note_s2))/2;
                }

                // // adding Bonus to licence
                $bonus=DB::table('filiere_licence')->select('filiere_licence.*')
                ->join('licence_user','licence_user.licence_id',"=",'filiere_licence.licence_id')
                ->where('filiere_licence.filiere_id', $request->id)
                ->where('licence_user.user_id',$candidat->id)
                ->first();

                if($bonus){
                    $note_partie_licence+=$bonus->bonus_licence;
                    $coefficient_licence=$bonus->coefficient_licence;
                }

                $coeff_total = $coefficient_bac+$coefficient_licence;
                if($coeff_total){
                    $score = (($note_partie_bac*$coefficient_bac)+($note_partie_licence*$coefficient_licence))/$coeff_total;
                    if($cuurent_school_year != $year_of_graduation->annee_obtention){
                        $score -= 1;
                    }
                }
                $candidat->score = round($score, 2);
            }

            $sortData = $data->sortBy('score')->reverse();
            return response()->json($sortData->values()->all());
        }
        else{
            return  redirect('dashboard');
        }
    }

    public function dashboard(){
        if(Auth::user()->role =="normal user"){
                    $user_id = Auth::user()->id;
        return view('dashboard',compact('user_id'));
        }
        elseif(Auth::user()->role =="admin"){
            $nombre_filieres = DB::table('filieres')->count();
            $nombre_candidats_inscrits=DB::table('users')->join('filiere_user','filiere_user.user_id','=','users.id')->count();
            //echo($nombre_candidats_inscrits);
            //echo($nombre_filieres);
            return view('statistique',compact('nombre_filieres','nombre_candidats_inscrits'));
        }else{
            $data_filiere =Filiere::all();
            return view('laravel-examples/user-management',compact('data_filiere'));

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
