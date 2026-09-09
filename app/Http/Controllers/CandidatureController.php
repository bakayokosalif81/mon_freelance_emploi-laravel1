<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatureController extends Controller
{
    // Enregistrer une candidature
    public function store(Request $request)
    {
        $request->validate([
            'offre_id'      => ['required', 'exists:offres,id'],
            'message'       => ['required', 'string'],
            'tarif_propose' => ['nullable', 'numeric'],
        ]);

        // Vérifier si le freelance a déjà postulé
        $existe = Candidature::where('user_id', Auth::id())
                              ->where('offre_id', $request->offre_id)
                              ->exists();

        if ($existe) {
            return back()->with('error', 'Vous avez déjà postulé à cette offre !');
        }

        Candidature::create([
            'user_id'       => Auth::id(),
            'offre_id'      => $request->offre_id,
            'message'       => $request->message,
            'tarif_propose' => $request->tarif_propose,
            'statut'        => 'en_attente',
        ]);

        return redirect()->route('offres.index')->with('success', 'Candidature envoyée avec succès !');
    }

    // Mes candidatures (freelance)
    public function index()
    {
        $candidatures = Candidature::with(['offre.client'])
                                    ->where('user_id', Auth::id())
                                    ->latest()
                                    ->get();
        return view('candidatures.index', compact('candidatures'));
    }

    // Candidatures reçues (client)
    public function received()
    {
        $candidatures = Candidature::with(['offre', 'freelance'])
                                    ->whereIn('offre_id', Auth::user()->offres()->pluck('id'))
                                    ->latest()
                                    ->get();
        return view('candidatures.received', compact('candidatures'));
    }

    // Accepter ou refuser une candidature
    public function updateStatut(Request $request, Candidature $candidature)
    {
        $request->validate([
            'statut' => ['required', 'in:acceptee,refusee'],
        ]);

        $candidature->update(['statut' => $request->statut]);

        return back()->with('success', 'Candidature mise à jour !');
    }
}