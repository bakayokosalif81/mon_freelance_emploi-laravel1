<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['nom', 'slug'];

    public function offres()
    {
        return $this->hasMany(Offre::class, 'categorie_id');
    }
}