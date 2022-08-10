<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Models\Filiere;

// , WithHeadings
class UsersExport implements FromCollection
{
    private $id;

    public function __construct(int $id) 
    {
        $this->id = $id;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::select("id", "last_name", "first_name", "cin", "cne")->get();
        // return DB::table('users')->select("users.id", "last_name", "first_name", "cin", "cne")
        // ->join('filiere_user','filiere_user.user_id','=','users.id')->get();
        // // ->join('filieres','filieres.id','=','filiere_user.filiere_id')->where('filieres.id',$id)->get();

        return DB::table('users')->select('users.*')->join('filiere_user','filiere_user.user_id','=','users.id')
        ->where('filiere_user.filiere_id', $this->id)->get();
    }   

    // public function headings(): array
    // {
    //     return ["ID", "Nom", "PRÉNOM", "CIN", "CNE"];
    // }
}
