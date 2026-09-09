<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs';

    protected $fillable = ['nom', 'email', 'mot_de_passe', 'role'];

    // Relations
    public function emplois()
    {
        return $this->hasMany(Emploi::class, 'recruteur_id');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'freelance_id');
    }

    public function messagesEnvoyes()
    {
        return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'destinataire_id');
    }

    public function profil()
    {
        return $this->hasOne(Profil::class);
    }
}
