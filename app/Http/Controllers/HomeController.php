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
            // $data=DB::table('users')->select('*')->join('filiere_user','filiere_user.user_id','=','users.id')
            // ->join('filieres','filieres.id','=','filiere_user.filiere_id')->where('filieres.id',$request->id)->get();
            // return response()->json($data);
            
            // $data=DB::table('users')->select('users.*')->join('filiere_user','filiere_user.user_id','=','users.id')
            // ->join('filieres','filieres.id','=','filiere_user.filiere_id')->where('filieres.id',$request->id)->get();

            // //calcul du partie bac : 
            // $produit_matiere_coeffecient=0;
            // $nombre_coefficients_matiere=0;
            // $bonus_bac_calcul=0;
            // $coefficient_bac_calcul=0;

            // //calcul du partie licence :
            // $coefficient_licence_calcul=0;
            // $bonus_licence_calcul=0;
            // $note_S1_S2=0;

            // foreach ($data as $candidat) {
            //     //calcul du partie bac : 
            //     $matieres=DB::table('matiere_user')->select('*')->join('matieres','matieres.id','=','matiere_user.matiere_id')->where('matiere_user.user_id',$candidat->id)->get();
            //     $bacs=DB::table('bac_user')->select('*')->join('bacs','bacs.id','=','bac_user.bac_id')->where('bac_user.user_id',$candidat->id)->get();

            //     //calcul du partie bac : 
            //     foreach($matieres as $matiere){
            //         $coefficients_matiere=DB::table('filiere_matiere')->select('*')->join('matieres','matieres.id','=','filiere_matiere.matiere_id')->where('filiere_matiere.matiere_id',$matiere->id)->get();
            //         foreach($coefficients_matiere as $coefficient){
            //             $produit_matiere_coeffecient+=$coefficient->coefficient_matiere*$matiere->note;
            //             $nombre_coefficients_matiere+=$coefficient->coefficient_matiere;
            //         }
            //     }

            //     foreach($bacs as $bac){
            //         $bonus_bac=DB::table('bac_filiere')->select('*')->join('bacs','bacs.id','=','bac_filiere.bac_id')->where('bac_filiere.bac_id',$bac->bac_id)->get();
            //         foreach($bonus_bac as $value){
            //             $bonus_bac_calcul+=$value->bonus_bac;
            //             $coefficient_bac_calcul+=$value->coefficient_bac;
            //         }
            //     }

            //     //calcul du partie licence :

            //     $licences=DB::table('licence_user')->select('*')->join('licences','licences.id','=','licence_user.user_id')->where('licence_user.user_id',$candidat->id)->get();
            //     foreach($licences as $licence){
            //         $note_S1_S2=( ( $licence->note_s1 + $licence->note_s2 )/2);
            //         $bonus_licences=DB::table('filiere_licence')->select('*')->join('licences','licences.id','=','filiere_licence.licence_id')->where('filiere_licence.licence_id',$licence->licence_id)->get();
            //         foreach($bonus_licences as $value){
            //             $bonus_licence_calcul+=$value->bonus_licence;
            //             $coefficient_licence_calcul+=$value->coefficient_licence;
            //         }
            //         $note_S1_S2+=$bonus_licence_calcul;
            //     }

            //     //calcul du partie bac : 
            //     $note_partie_bac=($produit_matiere_coeffecient/$nombre_coefficients_matiere)+$bonus_bac_calcul;
            //     $score=(($note_partie_bac * $coefficient_bac_calcul) +($note_S1_S2 * $coefficient_licence_calcul))/($coefficient_licence_calcul+$coefficient_bac_calcul);
                
            //     // adding score to condidate
            //     $candidat->score = $score;
            // }
            // $data=DB::table('users')->select('users.*')->join('filiere_user','filiere_user.user_id','=','users.id')
            // ->where('filiere_user.filiere_id',$request->filiere)->get();

            $data=DB::table('users')->select('users.*')->join('filiere_user','filiere_user.user_id','=','users.id')
            ->join('filieres','filieres.id','=','filiere_user.filiere_id')->where('filieres.id',$request->id)->get();

            foreach ($data as $candidat) {
                $total_note_matiere=0;
                $total_coefficient_matiere=0;
                $note_partie_bac=0;
                $note_partie_licence=0;
                $coefficient_bac=0;
                $coefficient_licence=0;
                
                $matieres=DB::table('matiere_user')->select('matiere_user.*')->join('matieres','matieres.id','=','matiere_user.matiere_id')->where('matiere_user.user_id',$candidat->id)->get();
                foreach($matieres as $matiere){
                    echo($matiere->note);
                    echo('</br>');
                    $coefficient_matiere=DB::table('filiere_matiere')->select('*')->where('filiere_matiere.matiere_id',$matiere->matiere_id)
                    ->where('filiere_matiere.filiere_id',$request->filiere)->get();

                    foreach($coefficient_matiere as $coefficient){
                        echo( $coefficient->coefficient_matiere);
                        echo('</br>');
                        $produit_matiere_coefficient=($matiere->note)*( $coefficient->coefficient_matiere);
                        echo($produit_matiere_coefficient);
                        echo('</br>');
                        $total_note_matiere+=$produit_matiere_coefficient;
                        $total_coefficient_matiere+=$coefficient->coefficient_matiere;
                    }  
                }
                echo($total_note_matiere);
                //note du partie bac avant l'ajout du bonus
                $note_partie_bac=$total_note_matiere/$total_coefficient_matiere;
                

                $bacs=DB::table('bac_filiere')->select('bac_filiere.*')->join('bac_user','bac_user.bac_id','=','bac_filiere.bac_id')
                ->where('bac_user.user_id',$candidat->id)->where('bac_filiere.filiere_id',$request->filiere)->get();
                

                foreach($bacs as $bac){
                    $note_partie_bac+=$bac->bonus_bac;
                    $coefficient_bac=$bac->coefficient_bac;
                }
                
                //NOTE DU PARTIE BAC APRES l'ajout du bonus 
                $licences=DB::table('licence_user')->select('licence_user.*')->join('licences','licences.id','=','licence_user.licence_id')->where('licence_user.user_id',$candidat->id)->get();
                
                foreach($licences as $licence){
                    $note_partie_licence=(($licence->note_s1)+($licence->note_s2))/2;
                }
            
                $bonus_licence=DB::table('filiere_licence')->select('filiere_licence.*')->join('licence_user','licence_user.licence_id',"=",'filiere_licence.licence_id')
                ->where('licence_user.user_id',$candidat->id)->where('filiere_licence.filiere_id',$request->filiere)->get();

                foreach($bonus_licence as $bonus){
                    $note_partie_licence+=$bonus->bonus_licence;
                    $coefficient_licence=$bonus->coefficient_licence;
                }

                $score=(($note_partie_bac*$coefficient_bac)+($note_partie_licence*$coefficient_licence))/($coefficient_bac+$coefficient_licence);
                $candidat->score = $score;
            }
            // return response()->json($data);
            return view('laravel-examples/user-management', compact('data'));
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
