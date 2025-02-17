<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Boxs;
use App\Models\Locataire;
use App\Models\Template;
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
        $templates = Template::where('user_id', auth()->id())->get();
        $locataires = Locataire::where('user_id', auth()->id())->get();
        $boxes = Boxs::where('user_id', auth()->id())->get();

        return view('contrats.create', compact('templates', 'locataires', 'boxes'));
    }

    public function edit(Contrat $contrat)
    {
        $templates = Template::where('user_id', auth()->id())->get();
        $locataires = Locataire::where('user_id', auth()->id())->get();
        $boxes = Boxs::where('user_id', auth()->id())->get();

        return view('contrats.edit', compact('contrat', 'templates', 'locataires', 'boxes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'prix_mois' => 'required|numeric|min:0',
            'locataire_id' => 'required|exists:locataires,id',
            'box_id' => 'required|exists:boxes,id',
            'template_id' => 'nullable|exists:templates,id'
        ]);

        $contrat =Contrat::create([
            'user_id' => auth()->id(),
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'prix_mois' => $request->prix_mois,
            'locataire_id' => $request->locataire_id,
            'box_id' => $request->box_id,
            'template_id' => $request->template_id
        ]);  

        return redirect()->route('contrats.index')->with('success', 'Contrat créé avec succès.');
    }

    public function update(Request $request, Contrat $contrat)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'prix_mois' => 'required|numeric|min:0',
            'locataire_id' => 'required|exists:locataires,id',
            'box_id' => 'required|exists:boxes,id',
            'template_id' => 'nullable|exists:templates,id'
        ]);

        $contrat->update([
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'prix_mois' => $request->prix_mois,
            'locataire_id' => $request->locataire_id,
            'box_id' => $request->box_id,
            'template_id' => $request->template_id
        ]);

        return redirect()->route('contrats.index')->with('success', 'Contrat mis à jour avec succès.');
    }


    public function show(Contrat $contrat)
    {
        // Vérifie si le contrat appartient à l'utilisateur connecté
        if ($contrat->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        return view('contrats.show', compact('contrats'));
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
