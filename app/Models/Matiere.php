<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function filieres(){
        return  $this->belongsToMany(Filiere::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
