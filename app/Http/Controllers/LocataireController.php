<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use Illuminate\Http\Request;

class LocataireController extends Controller
{
    // Affiche la liste des locataires pour l'utilisateur connecté
    public function index()
    {
        $locataires = Locataire::where('user_id', auth()->id())->get();

        return view('loc.index', compact('locataires'));
    }

    // Affiche le formulaire pour créer un nouveau locataire
    public function create()
    {
        return view('loc.create');
    }

    // Enregistre un nouveau locataire dans la base de données
    public function store(Request $request)
    {
        // Validation des données envoyées
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'tel' => 'required|string|max:15',
            'email' => 'required|email|unique:locataires,email',
            'adresse' => 'required|string',
            'compte_bancaire' => 'nullable|string|max:255',
        ]);

        // Ajout de l'utilisateur connecté comme propriétaire du locataire
        $validatedData['user_id'] = auth()->id();

        // Création du locataire
        Locataire::create($validatedData);

        // Redirection avec message de succès
        return redirect()->route('loc.index')->with('success', 'Locataire créé avec succès.');
    }

    // Affiche le formulaire d'édition d'un locataire
    public function edit($id)
    {
        $locataire = Locataire::where('user_id', auth()->id())->findOrFail($id);

        return view('loc.edit', compact('locataire'));
    }

    // Met à jour un locataire existant
    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'tel' => 'required|string|max:15',
            'email' => 'required|email|unique:locataires,email,' . $id,
            'adresse' => 'required|string',
            'compte_bancaire' => 'nullable|string|max:255',
        ]);

        // Récupération du locataire appartenant à l'utilisateur connecté
        $locataire = Locataire::where('user_id', auth()->id())->findOrFail($id);

        // Mise à jour des informations
        $locataire->update($validatedData);

        // Redirection avec message de succès
        return redirect()->route('loc.index')->with('success', 'Locataire mis à jour avec succès.');
    }

    // Supprime un locataire
    public function destroy($id)
    {
        $locataire = Locataire::where('user_id', auth()->id())->findOrFail($id);

        $locataire->delete();

        return redirect()->route('loc.index')->with('success', 'Locataire supprimé avec succès.');
    }
}
