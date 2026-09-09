<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MonProfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profil.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'bio'         => ['nullable', 'string', 'max:1000'],
            'competences' => ['nullable', 'string', 'max:500'],
            'photo'       => ['nullable', 'image', 'max:2048'],
        ]);

        $data = [
            'name'        => $request->name,
            'bio'         => $request->bio,
            'competences' => $request->competences,
        ];

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $user->update($data);

        return redirect()->route('profil.show')->with('success', 'Profil mis à jour avec succès !');
    }
}