<?php

namespace App\Http\Controllers\Matiere;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matiere;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatiereController extends Controller
{


    public function index(){
        if(Auth::user()->role=="admin"){
            $data_matiere = DB::table('matieres')->get();
            return view('Gestion_Matieres',compact('data_matiere'));
        }
        else{
            return redirect('dashboard');
        }
    }

    public function create(){
        if(Auth::user()->role =="admin"){
            return view('second-view/matiere/create');
        }
        else{
            return redirect('dashboard');
        }
    }

    public function store(Request $request){
        if(Auth::user()->role =="admin"){
            $matiere = new Matiere();
            $matiere->name = $request->name;
            $matiere->save();
            return redirect('matiere');
        }
        else{
            return redirect('dashboard');
        }

    }
    public function edit($id){
        if(Auth::user()->role=="admin"){
            $data_matiere = DB::table('matieres')->where('id',$id)->get();
            return view('second-view/matiere/update',compact('data_matiere'));
        }
        else{
            return redirect('dashboard');
        }
    }

    public function update(Request $request,$id){
        if(Auth::user()->role=="admin"){
            $matieres = Matiere::find($id);
            $input = $request->all();
            $matieres->update($input);
            return redirect('matiere');
        }
        else{
            return redirect('dashboard');
        }
    }

    public function delete($id){
        if(Auth::user()->role=="admin"){
            DB::table('matieres')->where('id',$id)->delete();
            return redirect('matiere');
        }
        else{
            return redirect('dashboard');
        }
    }
}