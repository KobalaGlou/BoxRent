<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Boxs;
use App\Models\Locataire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContratController extends Controller
{
    public function index()
    {
        // Récupère uniquement les contrats appartenant à l'utilisateur connecté
        $contrats = Contrat::where('user_id', Auth::id())->get();
        return view('contrats.index', compact('contrats'));
    }

    public function create()
    {
        // Récupère les locataires et les boxes de l'utilisateur connecté
        $boxes = Boxs::where('user_id', Auth::id())->get();
        $locataires = Locataire::where('user_id', Auth::id())->get();

        return view('contrats.create', compact('boxes', 'locataires'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'prix_mois' => 'required|numeric|min:0',
            'box_id' => 'required|exists:boxes,id',
            'locataire_id' => 'required|exists:locataires,id',
        ]);

        Contrat::create([
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'prix_mois' => $validated['prix_mois'],
            'user_id' => Auth::id(),
            'box_id' => $validated['box_id'],
            'locataire_id' => $validated['locataire_id'],
        ]);

        return redirect()->route('contrats.index')->with('success', 'Contrat créé avec succès.');
    }

    public function show(Contrat $contrat)
    {
        // Vérifie si le contrat appartient à l'utilisateur connecté
        if ($contrat->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        return view('contrats.show', compact('contrat'));
    }

    public function edit(Contrat $contrat)
    {
        // Vérifie si le contrat appartient à l'utilisateur connecté
        if ($contrat->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $boxes = Boxs::where('user_id', Auth::id())->get();
        $locataires = Locataire::where('user_id', Auth::id())->get();

        return view('contrats.edit', compact('contrat', 'boxes', 'locataires'));
    }

    public function update(Request $request, Contrat $contrat)
    {
        // Vérifie si le contrat appartient à l'utilisateur connecté
        if ($contrat->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'prix_mois' => 'required|numeric|min:0',
            'box_id' => 'required|exists:boxes,id',
            'locataire_id' => 'required|exists:locataires,id',
        ]);

        $contrat->update($validated);

        return redirect()->route('contrats.index')->with('success', 'Contrat mis à jour avec succès.');
    }

    public function destroy(Contrat $contrat)
    {
        // Vérifie si le contrat appartient à l'utilisateur connecté
        if ($contrat->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $contrat->delete();

        return redirect()->route('contrats.index')->with('success', 'Contrat supprimé avec succès.');
    }
}


