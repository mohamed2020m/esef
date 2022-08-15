<?php

namespace App\Http\Controllers\condidat;

use App\Http\Controllers\Controller;
use App\Models\Bac;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class CondidatController extends Controller
{
    public function donneeCondidat(){
        if(Auth::user()->role == "normal user"){
            $user_id = Auth::user()->id;
            $if_user_has_bac     = DB::table('bacs')->selectRaw('bacs.id,bacs.name')->join('bac_user','bac_user.bac_id','=','bacs.id')->join('users','users.id','=','bac_user.user_id')->where('users.id',$user_id)->get();
            $if_user_has_filiere = DB::table('filiere_user')->where('filiere_user.user_id',$user_id)->get();

            if($if_user_has_filiere->count() !=0){
                $bac_name = DB::table('bacs')->selectRaw('bacs.id,bacs.name')->join('bac_user','bac_user.bac_id','=','bacs.id')->join('users','users.id','=','bac_user.user_id')->where('users.id',$user_id)->get();
                $data_bac = DB ::table('bac_user')->where('user_id',$user_id)->get();
                $licence_name = DB::table('licences')->selectRaw('licences.id,licences.name')->join('licence_user','licence_user.licence_id','=','licences.id')->join('users','users.id','=','licence_user.user_id')->where('users.id',$user_id)->get();
                $data_licence = DB::table('licence_user')->where('user_id',$user_id)->get();
                return view('page-inscription/inscription-valide',compact('bac_name','data_bac','licence_name','data_licence'));
            }
            else if($if_user_has_bac->count() !=0){
                $bac_name = DB::table('bacs')->selectRaw('bacs.id,bacs.name')->join('bac_user','bac_user.bac_id','=','bacs.id')->join('users','users.id','=','bac_user.user_id')->where('users.id',$user_id)->get();
                $data_bac = DB ::table('bac_user')->where('user_id',$user_id)->get();
                $licence_name = DB::table('licences')->selectRaw('licences.id,licences.name')->join('licence_user','licence_user.licence_id','=','licences.id')->join('users','users.id','=','licence_user.user_id')->where('users.id',$user_id)->get();
                $data_licence = DB::table('licence_user')->where('user_id',$user_id)->get();

                $liste_bac = DB::table('bacs')->get();
                $liste_licence = DB::table('licences')->get();
                return view('page-inscription/inscription-non-valide',compact('liste_bac','liste_licence','bac_name','data_bac','licence_name','data_licence'));
            }
            else{
                $liste_bac = DB::table('bacs')->get();
                $liste_licence = DB::table('licences')->get();
                return view('page-inscription/inscription',compact('liste_bac','liste_licence'));
            }
        }
        else{
            return redirect('dashboard');
        }

    }

    public function storeDonneCondidat(Request $req){
        $user_id = User::where('id',Auth::user()->id)->first();
        $bac_id = $req->serie_bac;

        $scan_bac  = time().'.'.$req->scan_bac->extension();
        $req->scan_bac->move(public_path('images/scan_condidat/scan-bac'), $scan_bac);

        $scan_releve_note =time().'.'.$req->scan_releve_note->extension();
        $req->scan_releve_note->move(public_path('images/scan_condidat/scan-releve-note'), $scan_releve_note);

        $data_bac = [
            'type_bac' => $req->type_bac,
            'annee_obtention' => $req->annee_bac,
            'etablissment_obtention' => $req->etablissment_bac,
            'ville_obtention' => $req->ville_bac,
            'scan_bac' => $scan_bac,
            'scan_releve_note' => $scan_releve_note,
        ];

        $user_id->bacs()->attach($bac_id,$data_bac);

        //pour la licence

        $scan_s1 = time().'.'.$req->releve_s1->extension();
        $req->releve_s1->move(public_path('images/scan_condidat/scan-s1'), $scan_s1);
        $scan_s2 = time().'.'.$req->releve_s2->extension();
        $req->releve_s2->move(public_path('images/scan_condidat/scan-s2'), $scan_s2);

        $equivalent =0;
        if($req->licence_equivalent !=null){
            $equivalent = 1;
        }
        $data_licence = [
            'type_licence' =>$req->type_licence,
            'annee_obtention' =>$req->annee_licence,
            'etablissment_obtention' => $req->etablissment_licence,
            'ville_obtention' => $req->ville_licence,
            'note_s1' => $req->note_s1,
            'note_s2' => $req->note_s2,
            'releve_s1' => $scan_s1,
            'releve_s2' => $scan_s2,
            'equivalent' => $equivalent
        ];
        $licence_id = $req->genre_licence;
        $user_id->licences()->attach($licence_id,$data_licence);

        return redirect('dashboard');
    }

    public function viewDossier(){
        if(Auth::user()->role =="normal user"){
            $user_data  = DB::table('users')->where('id',Auth::user()->id)->get();
            $user_bac_name  = DB::table('bacs')->selectRaw('bacs.id,bacs.name')->join('bac_user','bac_user.bac_id','=','bacs.id')->join('users','users.id','=','bac_user.user_id')->where('users.id',Auth::user()->id)->get();
            $user_bac_data = DB::table('bac_user')->where('user_id',Auth::user()->id)->get();

            $user_licence_name = DB::table('licences')->selectRaw('licences.id,licences.name')->join('licence_user','licence_user.licence_id','=','licences.id')->join('users','users.id','=','licence_user.user_id')->where('users.id',Auth::user()->id)->get();
            $user_licence_data = DB::table('licence_user')->where('user_id',Auth::user()->id)->get();
            return view('dossier-condidat/dossier-condidat',compact('user_data','user_bac_name','user_licence_name','user_bac_data','user_licence_data'));
        }
        else{
            return redirect('dashboard');
        }
    }

    public function inscription_in_filiere(Request $req){
        $user_id =User::where('id',Auth::user()->id)->first();
        $filiere_id = $req->filiere_id;
        $user_id->filieres()->attach($filiere_id,['date' =>date('Y-m-d H:i:s')]);

        $liste_matieres = DB::table('matieres')->selectRaw('matieres.id,matieres.name')->join('filiere_matiere','filiere_matiere.matiere_id','=','matieres.id')->join('filieres','filieres.id','=','filiere_matiere.filiere_id')->where('filieres.id',$filiere_id)->get();

        for($i=0;$i<sizeof($liste_matieres);$i++){
            $matiere_id= $liste_matieres[$i]->id;
            $matiere_note = $req->$matiere_id;
            $user_id->matieres()->attach($matiere_id,['note' =>$matiere_note]);
        }
        return redirect()->back();
    }

    public function downloadPdf($id){
        if(Auth::user()->role =="normal user"){
            $user_id = Auth::user()->id;
            $user_data = DB::table('users')->where('id',$user_id)->get();
            $filiere_data = DB::table('filieres')->where('id',$id)->get();
            $condition = [
                'filiere_user.filiere_id' => $id,
                'filiere_user.user_id' => $user_id,
                        ];
            $register_in_filiere_at = DB::table('filiere_user')->where($condition)->get();
            $recu = PDF::loadView('liste-filiere-possible.recu-filiere',compact('user_data','filiere_data','register_in_filiere_at'));
            return $recu->download('recu.pdf');
        }
    }

    public function updateDonneeCondidat(Request $req){
        $user_id = Auth::user()->id;
        // if()
    }
}
