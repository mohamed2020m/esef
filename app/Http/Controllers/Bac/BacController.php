<?php

namespace App\Http\Controllers\Bac;

use App\Http\Controllers\Controller;
use App\Models\Bac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BacController extends Controller
{

    public function index(){
        if(Auth::user()->role=="admin"){
            $data_bac = DB::table('bacs')->get();
            return view('Gestion_Baccalaureat',compact('data_bac'));
        }
        else{
            return redirect('dashboard');
        }
    }
    public function create(){
        if(Auth::user()->role =="admin"){
            return view('second-view/bac/create');
        }
        else{
            return redirect('dashboard');
        }

    }
    public function store(Request $request){
        if(Auth::user()->role =="admin"){
            $bac = new Bac();
            $bac->name = $request->name;
            $bac->save();
            return redirect('bac');
        }
        else{
            return redirect('dashboard');
        }

    }

    public function edit($id){
        if(Auth::user()->role=="admin"){
            $data = DB::table('bacs')->where('id',$id)->get();
            return view('second-view/bac/update',compact('data'));
        }
        else{
            return redirect('dashboard');
        }
    }
    public function update(Request $request,$id){
        if(Auth::user()->role=="admin"){
            $bacs = Bac::find($id);
            $input = $request->all();
            $bacs->update($input);
            return redirect('bac');
        }
        else{
            return redirect('dashboard');
        }
    }

    public function delete($id){
        if(Auth::user()->role=="admin"){
            DB::table('bacs')->where('id',$id)->delete();
            return redirect('bac');
        }
        else{
            return redirect('dashboard');
        }
    }

}
