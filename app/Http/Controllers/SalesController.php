<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        // Récupération des dates de début et de fin (valeurs par défaut : début du mois / aujourd'hui)
        $date_debut = $request->input('date_debut', Carbon::now()->startOfMonth()->toDateString());
        $date_fin   = $request->input('date_fin',   Carbon::now()->toDateString());

        // Récupération des ventes entre ces dates avec leurs livres associés
        $ventes = Vente::with('livre')
            ->whereBetween('date', [$date_debut, $date_fin])
            ->get();

        // Calcul du total général avec vérification de la présence du livre
        $totalVentes = $ventes->sum(function ($vente) {
            return $vente->livre ? $vente->livre->prix * $vente->quantite : 0;
        });

        // Regroupement des ventes par date pour le graphique
        $salesByDate = $ventes
            ->groupBy(function ($v) {
                return Carbon::parse($v->date)->format('d/m/Y');
            })
            ->map(function ($group) {
                return $group->sum(function ($v) {
                    return $v->livre ? $v->livre->prix * $v->quantite : 0;
                });
            })
            ->toArray();

        // Passage des données à la vue
        return view('ventes.index', [
            'ventes'      => $ventes,
            'data'        => [
                'date_debut' => $date_debut,
                'date_fin'   => $date_fin,
            ],
            'totalVentes' => $totalVentes,
            'salesByDate' => $salesByDate,
        ]);
    }
}
