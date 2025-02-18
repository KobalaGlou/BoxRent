<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use Carbon\Carbon;

class ImpotsController extends Controller
{
    public function index()
    {
        $anneeActuelle = Carbon::now()->year;

        // Somme totale des factures de l'année en cours (payées et impayées)
        $revenusAnnuels = Facture::whereYear('date_creation', $anneeActuelle)
                                ->sum('montant');

        return view('impots.index', compact('revenusAnnuels'));
    }
}
