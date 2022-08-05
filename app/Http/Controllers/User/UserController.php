<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Global_;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function afficher(){
        if(Auth::user()->role =="admin"){
           
    $inscrits=DB::table('users')->select('*')->join('filiere_user','filiere_user.user_id','=','users.id')->get();
            
            return view('second-view/candidat/liste_des_inscrits',compact('inscrits'));
        }
        else{
            return  redirect('dashboard');
        }
    }



    public function getUtilisateurs(Request $request){
        if(Auth::user()->role =="admin"){
           ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');


        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value


         // Total records
         
         $totalRecords =DB::table('users')->select('count(*) as allcount')->join('filiere_user','filiere_user.user_id','=','users.id')->count();
         $totalRecordswithFilter = DB::table('users')->select('count(*) as allcount')->join('filiere_user','filiere_user.user_id','=','users.id')->where('last_name', 'like', '%' .$searchValue . '%')->count();
   

            // Fetch records
            $records =  DB::table('users')->select('*')->join('filiere_user','filiere_user.user_id','=','users.id')->
            where('users.last_name','like', '%' .$searchValue . '%')->orderBy($columnName,$columnSortOrder)->
            skip($start)->take($rowperpage)->get();


            $data_arr = array();

            foreach($records as $record){
               $id = $record->id;
               $photo = $record->photo;
               $first_name = $record->first_name;
               $last_name = $record->last_name;
               $cin =$record->cin;
               $role=$record->role;
    
               $data_arr[] = array(
                   "id" => $id,
                   "photo" => $photo,
                   "first_name" => $first_name,
                   "last_name" => $last_name,
                   "cin" => $cin,
                   "role" => $role
               );
            }
        }
        else{
            return  redirect('dashboard');
        }
    }
}
