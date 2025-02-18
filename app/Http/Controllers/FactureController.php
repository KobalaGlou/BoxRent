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


    // Générer les factures pour un contra

    public function genererFactures()
    {
        $dateActuelle = Carbon::now(); // Date actuelle

        // Récupérer tous les contrats actifs durant le mois en cours
        $contrats = Contrat::whereDate('date_debut', '<=', $dateActuelle->endOfMonth())
            ->whereDate('date_fin', '>=', $dateActuelle->startOfMonth())
            ->get();


        foreach ($contrats as $contrat) {
            $dateFacture = $dateActuelle->format('Ymd'); // Format YYYYMMDD
            $idFacture = "{$dateFacture}_{$contrat->id}_" . $dateActuelle->month; // ID unique

            // Vérifier si la facture existe déjà
            if (Facture::where('id', $idFacture)->exists()) {
                continue; // Passer au contrat suivant
            }

            // Création de la facture
            Facture::create([
                'id' => $idFacture,
                'contrat_id' => $contrat->id,
                'montant' => $contrat->prix_mois,
                'date_creation' => now(),
                'periode' => $dateActuelle->month,
                'date_paiement' => null
            ]);
        }

        return redirect()->route('contrats.index')->with('success', 'Factures générées pour ce mois.');
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
