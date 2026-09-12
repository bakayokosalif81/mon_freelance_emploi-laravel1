<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offre extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'categorie_id', 'titre',
        'description', 'budget', 'statut',
        'en_vedette', 'vedette_statut'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'offre_id');
    }
}
