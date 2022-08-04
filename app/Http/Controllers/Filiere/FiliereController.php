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
            
            $data_bac = DB::table('bacs')->get();
            $data_matiere = DB::table('matieres')->get();
            $data_licence = DB::table('licences')->get();

           
            
            return view('filiere/update',compact('data_filiere','data_bac','data_matiere','data_licence'));
        }
        else{
            return redirect('dashboard');
        }
    }

    public function update(Request $request,$id){
        if(Auth::user()->role =="admin"){
            $filieres = Filiere::find($id);
            $input = $request->all();
            $filieres->update($input);
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


