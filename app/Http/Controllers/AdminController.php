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

    // Liste des offres actives (non supprimées)
    public function offres()
    {
        $offres = Offre::with(['client', 'categorie'])->latest()->paginate(15);
        return view('admin.offres', compact('offres'));
    }

    // Envoyer une offre à la corbeille (suppression douce)
    public function deleteOffre(Offre $offre)
    {
        $offre->delete();
        return back()->with('success', 'Offre déplacée dans la corbeille !');
    }

    // Voir la corbeille (offres supprimées)
    public function corbeilleOffres()
    {
        $offres = Offre::onlyTrashed()->with(['client', 'categorie'])->latest('deleted_at')->paginate(15);
        return view('admin.offres-corbeille', compact('offres'));
    }

    // Restaurer une offre depuis la corbeille
    public function restoreOffre($id)
    {
        $offre = Offre::onlyTrashed()->findOrFail($id);
        $offre->restore();
        return back()->with('success', 'Offre restaurée avec succès !');
    }

    // Supprimer définitivement une offre (irréversible)
    public function forceDeleteOffre($id)
    {
        $offre = Offre::onlyTrashed()->findOrFail($id);
        $offre->forceDelete();
        return back()->with('success', 'Offre supprimée définitivement !');
    }

    // Activer la mise en vedette d'une offre (après réception du paiement)
    public function activerVedette(Offre $offre)
    {
        $offre->update([
            'en_vedette'     => true,
            'vedette_statut' => 'active',
        ]);

        return back()->with('success', 'Offre mise en vedette activée !');
    }

    // Désactiver la mise en vedette d'une offre
    public function desactiverVedette(Offre $offre)
    {
        $offre->update([
            'en_vedette'     => false,
            'vedette_statut' => 'aucune',
        ]);

        return back()->with('success', 'Mise en vedette désactivée !');
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
