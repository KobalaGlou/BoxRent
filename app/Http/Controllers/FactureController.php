<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Contrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FactureController extends Controller
{
    // Afficher toutes les factures de l'utilisateur
    public function index()
    {
        $factures = Facture::with(['contrat.locataire'])->whereHas('contrat', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('factures.index', compact('factures'));
    }

    public function impayes()
    {
        $factures = Facture::with(['contrat.locataire'])
            ->whereNull('date_paiement')
            ->whereHas('contrat', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('factures.impayes', compact('factures'));
    }

    public function historique()
    {
        $factures = Facture::with(['contrat.locataire'])
            ->whereNotNull('date_paiement')
            ->whereHas('contrat', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('factures.historique', compact('factures'));
    }


    // Générer les factures pour un contrat
    public function genererFactures(Contrat $contrat)
    {
        // Vérification de l'autorisation de l'utilisateur
        if ($contrat->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        // Vérifier si les factures existent déjà
        if ($contrat->factures()->exists()) {
            return redirect()->route('contrats.index')->with('error', 'Les factures ont déjà été générées.');
        }

        $dateDebut = Carbon::parse($contrat->date_debut);
        $dateFin = Carbon::parse($contrat->date_fin);
        $moisCount = $dateDebut->diffInMonths($dateFin) + 1;

        for ($i = 0; $i < $moisCount; $i++) {
            $dateFacture = $dateDebut->copy()->addMonths($i)->format('Ymd'); // Date de la facture
            $idFacture = "{$dateFacture}_{$contrat->id}_" . ($i + 1); // Format YYYYMMDD_ContratID_Période

            Facture::create([
                'id' => $idFacture, // L'ID devient la clé primaire
                'contrat_id' => $contrat->id,
                'montant' => $contrat->prix_mois,
                'date_creation' => now(),
                'periode' => $i + 1,
                'date_paiement' => null
            ]);
        }

        return redirect()->route('contrats.index')->with('success', 'Factures générées avec succès.');
    }


    // Mettre à jour une facture (ajout de la date de paiement)
    public function update(Request $request, Facture $facture)
    {
        if ($facture->contrat->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $request->validate([
            'date_paiement' => 'nullable|date'
        ]);

        $facture->update([
            'date_paiement' => $request->date_paiement
        ]);

        return redirect()->route('factures.impayes')->with('success', 'Facture mise à jour.');
    }
}
