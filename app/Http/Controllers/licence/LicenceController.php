<?php

namespace App\Http\Controllers\licence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Licence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LicenceController extends Controller
{
    

    
    public function index(){
        if(Auth::user()->role=="admin"){
            $data_licence = DB::table('licences')->get();
            return view('Gestion_Licences',compact('data_licence'));
        }
        else{
            return redirect('dashboard');
        }
    }

    public function create(){
        if(Auth::user()->role =="admin"){
            return view('second-view/licence/create');
        }
        else{
            return redirect('dashboard');
        }

    }

    
    public function store(Request $request){
        if(Auth::user()->role =="admin"){
            $licence = new Licence();
            $licence->name = $request->name;
            $licence->save();
            return redirect('licence');
        }
        else{
            return redirect('dashboard');
        }

    }

    public function edit($id){
        if(Auth::user()->role=="admin"){
            $data_licence = DB::table('licences')->where('id',$id)->get();
            return view('second-view/licence/update',compact('data_licence'));
        }
        else{
            return redirect('dashboard');
        }
    }

    public function update(Request $request,$id){
        if(Auth::user()->role=="admin"){
            $licences = Licence::find($id);
            $input = $request->all();
            $licences->update($input);
            return redirect('licence');
        }
        else{
            return redirect('dashboard');
        }
    }

    public function delete($id){
        if(Auth::user()->role=="admin"){
            DB::table('licences')->where('id',$id)->delete();
            return redirect('licence');
        }
        else{
            return redirect('dashboard');
        }
    }

}
