<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select("id", "last_name", "first_name", "cin", "cne")->get();
    }

    public function headings(): array
    {
        return ["id", "last_name", "first_name", "cin", "cne"];
    }
}
