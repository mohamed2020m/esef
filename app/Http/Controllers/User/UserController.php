<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Global_;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function afficher(){
        if(Auth::user()->role =="admin"){
           
    //$inscrits=DB::table('users')->select('*')->join('filiere_user','filiere_user.user_id','=','users.id')->get();
    $inscrits=DB::table('users')->get();    
    

            return view('second-view/candidat/liste_des_inscrits',compact('inscrits'));
        }
        else{
            return  redirect('dashboard');
        }
    }



    public function getUtilisateurs(Request $request){
        if(Auth::user()->role =="admin"){
         
          $search = $request->query('search', array('value' => '', 'regex' => false));
          $draw = $request->query('draw', 0);
          $start = $request->query('start', 0);
          $length = $request->query('length', 25);
          $order = $request->query('order', array(1, 'asc'));        
      
          $filter = $search['value'];
      
          $sortColumns = array(
              0 => 'users.id',
              1 => 'users.first_name',
              2 => 'users.last_name',
              3 => 'users.cin',
              4 => 'users.role',
            
          );
      
          //$query = User::join('filiere_user', 'filiere_user.user_id', '=', 'users.id')->select('users.*');
          $query=User::all();
          if (!empty($filter)) {
              $query->where('users.first_name', 'like', '%'.$filter.'%')
              ->orwhere('users.last_name', 'like', '%'.$filter.'%')
              ->orwhere('users.cin', 'like', '%'.$filter.'%')
              ->orwhere('users.role', 'like', '%'.$filter.'%');
          }
      
          $recordsTotal = $query->count();
      
          $sortColumnName = $sortColumns[$order[0]['column']];
      
          $query->orderBy($sortColumnName, $order[0]['dir'])
                  ->take($length)
                  ->skip($start);
      
          $json = array(
              'draw' => $draw,
              'recordsTotal' => $recordsTotal,
              'recordsFiltered' => $recordsTotal,
              'data' => [],
          );
      
          $users = $query->get();
      
          foreach ($users as $user) {
            if ($user->role == "admin"){
                $json['data'][] = [
                    $user->id,
                    $user->first_name,
                    $user->last_name,
                    $user->cin,
                    "admin",
                   
                ];

            }else{

                $json['data'][] = [
                    $user->id,
                    $user->first_name,
                    $user->last_name,
                    $user->cin,
                    "candidat",
                   
                ];
            }
      
              
          }
      
          return $json;
        }
        else{
            return  redirect('dashboard');
        }
    }





        public function createadmin(){
            if(Auth::user()->role =="admin"){

                return view('second-view/Admin/index');
            }
            else{
                return  redirect('dashboard');
            }


        }



        public function storeadmin(Request $request){
            if(Auth::user()->role =="admin"){


              

                $admin = new User();
                $admin->last_name=$request->lname;
                $admin->first_name=$request->fname;
                $admin->email=$request->email;
                $admin->password=$request->mdp;
                $admin->role=$request->role;
                $admin->save();

               
                return  redirect('utilisateurs');
            }
            else{
                return  redirect('dashboard');
            }


        }


}
