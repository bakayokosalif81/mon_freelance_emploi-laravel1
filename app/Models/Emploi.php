<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    use HasFactory;

    protected $table = 'emplois';

    protected $fillable = ['titre', 'description', 'categorie', 'budget', 'recruteur_id'];

    public function recruteur()
    {
        return $this->belongsTo(Utilisateur::class, 'recruteur_id');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
}
