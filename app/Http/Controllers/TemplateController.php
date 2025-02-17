<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::where('user_id', auth()->id())->get();

        return view('templates.index', compact('templates'));
    }


    public function showContratTemplate(Template $template, Contrat $contrat)
    {
        $content = $template->content;

        // Liste des valeurs à insérer dans le contrat
        $placeholders = [
            '[NAME]'   => $contrat->locataire->nom,
            '[BOX]'    => $contrat->box->description,
            '[DATE_D]' => $contrat->date_debut->format('d/m/Y'),
            '[DATE_F]' => $contrat->date_fin->format('d/m/Y'),
            '[PRIX]'   => number_format($contrat->prix_mois, 2, ',', ' ') . ' €',
        ];

        // Remplacement des balises
        $renderedContent = str_replace(array_keys($placeholders), array_values($placeholders), $content);

        return view('contrats.render', compact('renderedContent', 'template'));
    }


    public function create()
    {
        return view('templates.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required',
        ]);

        Template::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return redirect()->route('templates.index')->with('success', 'Template créé avec succès.');
    }


    public function edit(Template $template)
    {
        return view('templates.edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $template->update([
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return redirect()->route('templates.index')->with('success', 'Template mis à jour avec succès.');
    }

    public function destroy(Template $template)
    {
        $template->delete();

        return redirect()->route('templates.index')->with('success', 'Template supprimé avec succès.');
    }
}
