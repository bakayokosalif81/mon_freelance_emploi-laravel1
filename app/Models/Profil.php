<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profils';

    protected $fillable = ['utilisateur_id', 'titre', 'biographie', 'competences'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
