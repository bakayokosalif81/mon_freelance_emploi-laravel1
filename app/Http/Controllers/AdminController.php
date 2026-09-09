<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offre;
use App\Models\Categorie;
use App\Models\Candidature;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Tableau de bord admin
    public function index()
    {
        $stats = [
            'users'        => User::count(),
            'freelances'   => User::where('role', 'freelance')->count(),
            'clients'      => User::where('role', 'client')->count(),
            'offres'       => Offre::count(),
            'offres_ouvertes' => Offre::where('statut', 'ouverte')->count(),
            'candidatures' => Candidature::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // Liste des utilisateurs
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    // Supprimer un utilisateur
    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé !');
    }

    // Liste des offres
    public function offres()
    {
        $offres = Offre::with(['client', 'categorie'])->latest()->paginate(15);
        return view('admin.offres', compact('offres'));
    }

    // Supprimer une offre
    public function deleteOffre(Offre $offre)
    {
        $offre->delete();
        return back()->with('success', 'Offre supprimée !');
    }

    // Liste des catégories
    public function categories()
    {
        $categories = Categorie::withCount('offres')->latest()->paginate(15);
        return view('admin.categories', compact('categories'));
    }

    // Ajouter une catégorie
    public function storeCategorie(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:categories,nom'],
        ]);

        Categorie::create([
            'nom'  => $request->nom,
            'slug' => \Str::slug($request->nom),
        ]);

        return back()->with('success', 'Catégorie ajoutée !');
    }

    // Supprimer une catégorie
    public function deleteCategorie(Categorie $categorie)
    {
        $categorie->delete();
        return back()->with('success', 'Catégorie supprimée !');
    }
}