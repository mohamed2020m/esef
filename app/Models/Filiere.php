<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function bacs(){
        return $this->belongsToMany(Bac::class);
    }

    public function matieres(){
        return $this->belongsToMany(Matiere::class);
    }
    public function licences(){
        return $this->belongsToMany(Licence::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
