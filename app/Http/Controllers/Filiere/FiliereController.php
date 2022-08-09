<?php

namespace App\Http\Controllers\Filiere;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bac;
use App\Models\Matiere;
use App\Models\Licence;
use App\Models\Filiere;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FiliereController extends Controller
{

    public function create(Request $request){
        $filiere = new Filiere;
        $filiere->name = $request->filiere_name;
        $filiere->save();

        $last_filiere = Filiere::orderBy('created_at','desc')->first();

        //     pour l'isertion des donnees filiere bac
        if($request->checkbox_bac != null ){
            $checkbox_bac = $request->checkbox_bac;
            $lent_bac = sizeof($checkbox_bac);
            for($i =0;$i<$lent_bac;$i++){
                $bonus_bac = "bonus_bac".$checkbox_bac[$i];
                $coefficient_bac = "coefficient_bac".$checkbox_bac[$i];
                $last_filiere->bacs()->attach($checkbox_bac[$i],['bonus_bac' =>$request->$bonus_bac,'coefficient_bac' =>$request->$coefficient_bac]);
            }
        }


        //     pour l'isertion des donnees filiere matiere
        if($request->checkbox_matiere!= null){
            $checkbox_matiere =$request->checkbox_matiere;
            $lent_matiere = sizeof($checkbox_matiere);
            for ($j=0;$j<$lent_matiere;$j++){
                $coefficient_matiere = "coefficient_matiere".$checkbox_matiere[$j];
                $last_filiere->matieres()->attach($checkbox_matiere[$j],['coefficient_matiere' =>$request->$coefficient_matiere]);
            }
        }

            //pour l'isertion des donnees filiere licence

        if($request->checkbox_licence != null){
                        $checkbox_licence = $request->checkbox_licence;
            $lent_licence = sizeof($checkbox_licence);
            for ($k=0;$k<$lent_licence;$k++){
                $bonus_licence = "bonus_licence".$checkbox_licence[$k];
                $coefficient_licence = "coefficient_licence".$checkbox_licence[$k];
                $last_filiere->licences()->attach($checkbox_licence[$k],['bonus_licence' =>$request->$bonus_licence,'coefficient_licence' =>$request->$coefficient_licence]);

            }
        }

        return redirect('filiere');

    }
    
    public function index(){
        if(Auth::user()->role =="admin"){
        
        $data_bac = DB::table('bacs')->get();
        $data_matiere = DB::table('matieres')->get();
        $data_licence = DB::table('licences')->get();
        return view('filiere/create',compact('data_bac','data_matiere','data_licence'));
        }
        else{
            return redirect('dashboard');
        }
    }

    public function show(){

        if(Auth::user()->role =="admin"){
            $data_filiere = DB::table('filieres')->get();
          
            return view('Gestion_Filieres',compact('data_filiere'));
            }
            else{
                return redirect('dashboard');
            }
    }

   

        public function edit($id,Request $request){
            if(Auth::user()->role=="admin"){
            $data_filiere = DB::table('filieres')->where('id',$id)->get();

            $bacs                 = DB::table('bacs')->get();
            $bac_in_filiere       =DB::table('bac_filiere')->where('filiere_id',$id)->orderBy('bac_id')->get();
            $bac_not_in_filiere   = DB::table('bacs')->selectRaw('bacs.id,bacs.name')
                                  ->whereNotIn('bacs.id',DB::table('bac_filiere')
                                  ->selectRaw('bac_filiere.bac_id')->where('filiere_id',$id)
                                  )->get();

            $matieres               = DB::table('matieres')->get();
            $matiere_in_filiere     = DB::table('filiere_matiere')->where('filiere_id',$id)->orderBy('matiere_id')->get();
            $matiere_not_in_filiere = DB::table('matieres')->selectRaw('matieres.id,matieres.name')
                                    ->whereNotIn('matieres.id',DB::table('filiere_matiere')
                                        ->selectRaw('filiere_matiere.matiere_id')->where('filiere_id',$id)
                                    )->get();

            $licences               = DB::table('licences')->get();
            $licence_in_filiere     = DB::table('filiere_licence')->where('filiere_id',$id)->orderBy('licence_id')->get();
            $licence_not_in_filiere = DB::table('licences')->selectRaw('licences.id,licences.name')
                                    ->whereNotIn('licences.id',DB::table('filiere_licence')
                                        ->selectRaw('filiere_licence.licence_id')->where('filiere_id',$id)
                                    )->get();


            return view('filiere/update',compact('data_filiere','bacs','bac_in_filiere','bac_not_in_filiere',
                                                                'matieres','matiere_in_filiere','matiere_not_in_filiere',
                                                                'licences','licence_in_filiere','licence_not_in_filiere'));
        }
        else{
            return redirect('dashboard');
        }
    }

    public function update(Request $request,$id){
        if(Auth::user()->role =="admin"){
            $filieres = Filiere::find($id);
            $name = $request->filiere_name;
            $filieres->update(['name' =>$name]);
            $filieres->bacs()->detach();
            $filieres->matieres()->detach();
            $filieres->licences()->detach();



            //     pour l'isertion des donnees filiere bac
        if($request->checkbox_bac != null ){
            $checkbox_bac = $request->checkbox_bac;
            $lent_bac = sizeof($checkbox_bac);
            for($i =0;$i<$lent_bac;$i++){
                $bonus_bac = "bonus_bac".$checkbox_bac[$i];
                $coefficient_bac = "coefficient_bac".$checkbox_bac[$i];
                $filieres->bacs()->attach($checkbox_bac[$i],['bonus_bac' =>$request->$bonus_bac,'coefficient_bac' =>$request->$coefficient_bac]);
            }
        }

           //     pour l'isertion des donnees filiere matiere
        if($request->checkbox_matiere!= null){
          $checkbox_matiere =$request->checkbox_matiere;
        $lent_matiere = sizeof($checkbox_matiere);
            for ($j=0;$j<$lent_matiere;$j++){
              $coefficient_matiere = "coefficient_matiere".$checkbox_matiere[$j];
              $filieres->matieres()->attach($checkbox_matiere[$j],['coefficient_matiere' =>$request->$coefficient_matiere]);
        }
        }
                //     pour l'isertion des donnees filiere LICENCE
        if($request->checkbox_licence != null){
            $checkbox_licence = $request->checkbox_licence;
            $lent_licence = sizeof($checkbox_licence);
            for ($k=0;$k<$lent_licence;$k++){
                 $bonus_licence = "bonus_licence".$checkbox_licence[$k];
                $coefficient_licence = "coefficient_licence".$checkbox_licence[$k];
                $filieres->licences()->attach($checkbox_licence[$k],['bonus_licence' =>$request->$bonus_licence,'coefficient_licence' =>$request->$coefficient_licence]);
         }}



            return redirect('filiere');
        }
        else{
            return redirect('dashboard');
        }
    }


    public function delete($id){
        if(Auth::user()->role=="admin"){
            $filieres = Filiere::find($id);
            $filieres->bacs()->detach();
            $filieres->matieres()->detach();
            $filieres->licences()->detach();
            DB::table('filieres')->where('id',$id)->delete();

            return redirect('filiere');
        }
        else{
            return redirect('dashboard');
        }
    }


}


