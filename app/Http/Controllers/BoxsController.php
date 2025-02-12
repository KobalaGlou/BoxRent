<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boxs;

class BoxsController extends Controller
{
    public function index()
    {
        $boxs = Boxs::all();
        return view('boxs.index', compact('boxs'));
    }

    public function create()
    {
        return view('boxs.create');
    }

    public function store(Request $request)
    {
        // Valider les données envoyées
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'lieux' => 'required|string',
            'prix' => 'required|numeric',
            'occupé' => 'required|boolean',
        ]);

        // Ajouter automatiquement l'ID de l'utilisateur connecté
        $validatedData['user_id'] = auth()->id();

        // Créer une nouvelle box avec les données validées
        Boxs::create($validatedData);

        // Rediriger avec un message de succès
        return redirect()->route('boxs.index')->with('success', 'Box créée avec succès.');
    }

    public function edit($id)
    {
        $box = Boxs::findOrFail($id); // Récupère la box à modifier
        return view('boxs.edit', compact('box')); // Retourne la vue avec les données de la box
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:1000',
            'lieux' => 'nullable|string|max:255',
            'prix' => 'nullable|numeric|min:0',
            'occupé' => 'required|boolean',
        ]);

        $box = Boxs::findOrFail($id);
        $box->update($request->all());

        return redirect()->route('boxs.index')->with('success', 'Box mise à jour avec succès !');
    }

    public function destroy($id)
    {
        $box = Boxs::findOrFail($id);
        $box->delete();

        return redirect()->route('boxs.index')->with('success', 'Box supprimée avec succès !');
    }
}
