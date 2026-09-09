<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    // Liste des offres avec recherche et filtres
    public function index(Request $request)
    {
        $query = Offre::with(['client', 'categorie'])->where('statut', 'ouverte');

        // Recherche par mot-clé
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filtre par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }

        // Filtre par budget max
        if ($request->filled('budget_max')) {
            $query->where('budget', '<=', $request->budget_max);
        }

        $offres = $query->latest()->paginate(10)->withQueryString();
        $categories = Categorie::all();

        return view('offres.index', compact('offres', 'categories'));
    }

    // Formulaire création (pour les clients)
    public function create()
    {
        $categories = Categorie::all();
        return view('offres.create', compact('categories'));
    }

    // Enregistrer une offre
    public function store(Request $request)
    {
        $request->validate([
            'titre'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'budget'       => ['nullable', 'numeric'],
            'categorie_id' => ['required', 'exists:categories,id'],
        ]);

        Offre::create([
            'user_id'      => Auth::id(),
            'titre'        => $request->titre,
            'description'  => $request->description,
            'budget'       => $request->budget,
            'categorie_id' => $request->categorie_id,
            'statut'       => 'ouverte',
        ]);

        return redirect()->route('dashboard')->with('success', 'Offre publiée avec succès !');
    }

    // Détail d'une offre
    public function show(Offre $offre)
    {
        $offre->load(['client', 'categorie', 'candidatures']);
        return view('offres.show', compact('offre'));
    }

    // Formulaire modification
    public function edit(Offre $offre)
    {
        $categories = Categorie::all();
        return view('offres.edit', compact('offre', 'categories'));
    }

    // Mettre à jour une offre
    public function update(Request $request, Offre $offre)
    {
        $request->validate([
            'titre'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'budget'       => ['nullable', 'numeric'],
            'categorie_id' => ['required', 'exists:categories,id'],
            'statut'       => ['required', 'in:ouverte,fermee,en_cours'],
        ]);

        $offre->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Offre mise à jour !');
    }

    // Supprimer une offre
    public function destroy(Offre $offre)
    {
        $offre->delete();
        return redirect()->route('dashboard')->with('success', 'Offre supprimée !');
    }
}