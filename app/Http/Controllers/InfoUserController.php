<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class InfoUserController extends Controller
{

    public function create()
    {
        if(Auth::user()->role =="admin"){
            return view('laravel-examples/admin-profile');
        }
        else{
            return view('laravel-examples/user-profile');
        }
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);
        if($request->get('email') != Auth::user()->email)
        {
            if(env('IS_DEMO') && Auth::user()->id == 1)
            {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);

            }

        }
        else{
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }


        User::where('id',Auth::user()->id)
        ->update([
            'last_name'    => $attributes['last_name'],
            'first_name'    => $attributes['first_name'],
            'last_name_arabic' =>$attributes['last_name_arabic'],
            'first_name_arabic' =>$attributes['first_name_arabic'],
            'birthday' =>$attributes['birthday'],
            'birth_place' =>$attributes['birth_place'],
            'cin' =>$attributes['cin'],
            'cne' =>$attributes['CNE'],
            'phone' =>$attributes['phone'],
            'email' => $attribute['email'],
            'phone'     => $attributes['phone']
        ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }
    public function updateProfile(Request $request){
        if($request->image_profile !=""){
            $image  = time().'.'.$request->image_profile->extension();
            $request->image_profile->move(public_path('images/images_profiles'), $image);
        }
        else if(Auth::user()->photo !="student_avatar.png"){
            $image = Auth::user()->photo;
        }
        else{
            $image = "student_avatar.png";
        }

        if($request->cin_first_face !=""){
            $image_cin_first_face  = time().'.'.$request->cin_first_face->extension();
            $request->cin_first_face->move(public_path('images/images_cin/first_face'), $image_cin_first_face);
        }
        else{
            $image_cin_first_face = Auth::user()->cin_image_face1;
        }

        if($request->cin_second_face !=""){
            $image_cin_second_face  = time().'.'.$request->cin_second_face->extension();
            $request->cin_second_face->move(public_path('images/images_cin/second_face'), $image_cin_second_face);
        }
        else{
            $image_cin_second_face = Auth::user()->cin_image_face2;
        }

        $update=[
            'last_name'    => $request->last_name,
            'first_name'    => $request->first_name,
            'last_name_arabic' =>$request->last_name_arabic,
            'first_name_arabic' =>$request->first_name_arabic,
            'birthday' =>$request->birthday,
            'birth_place' =>$request->birth_place,
            'cin' =>$request->cin,
            'cne' =>$request->cne,
            'phone' =>$request->phone,
            'photo' =>$image,
            'cin_image_face1' =>$image_cin_first_face,
            'cin_image_face2' => $image_cin_second_face,

        ];
        User::where('id',Auth::user()->id)->update($update);
        return redirect('/user-profile');
    }

    public function detailUser($id){
        if(Auth::user()->role =="admin"||Auth::user()->role =="professeur"){
            $user_data = DB::table('users')->where('id',$id)->get();
            $user_bac_name  = DB::table('bacs')->selectRaw('bacs.id,bacs.name')->join('bac_user','bac_user.bac_id','=','bacs.id')->join('users','users.id','=','bac_user.user_id')->where('users.id',Auth::user()->id)->get();
            $user_bac_data = DB::table('bac_user')->where('user_id',$id)->get();
            
            $user_licence_name = DB::table('licences')->selectRaw('licences.id,licences.name')->join('licence_user','licence_user.licence_id','=','licences.id')->join('users','users.id','=','licence_user.user_id')->where('users.id',Auth::user()->id)->get();
            $user_licence_data = DB::table('licence_user')->where('user_id',$id)->get();
            
            // $data = DB::table('users')->where('id',$id)->get();
            // return view('laravel-examples/user_detail',compact('data'));
            return view('laravel-examples/user_detail', compact('user_data','user_bac_name','user_licence_name','user_bac_data','user_licence_data'));
        }
        else{
            return view('dashboard');
        }

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

    public function deleteUser($id){
        if(Auth::user()->role =="admin" ){
            DB::table('users')->where('id',$id)->delete();
            return redirect('/user-management');
        }
        else{
            return view('dashboard');
        }
    }

    public function deleteCandidat($id){
        if(Auth::user()->role =="admin" ){
            DB::table('users')->where('id',$id)->delete();
            return redirect('utilisateurs');
        }
        else{
            return view('dashboard');
        }
    }

    public function export($id) 
    {
        $filier_name = DB::table('filieres')->where('id',$id)->value('name');
        return Excel::download(new UsersExport($id, $filier_name), 'Filière-'. $filier_name . '-'. time() . '.xlsx');
    }
}
