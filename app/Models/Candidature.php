<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'user_id', 'offre_id', 'message',
        'tarif_propose', 'statut'
    ];

    public function freelance()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function offre()
    {
        return $this->belongsTo(Offre::class, 'offre_id');
    }
}