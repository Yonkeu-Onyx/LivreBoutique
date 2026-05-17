<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Vente;
use App\Models\Client;
use Carbon\Carbon;

class SalesParClientController extends Controller
{
    public function index(Request $request)
{
    $date_debut = $request->input('date_debut', Carbon::now()->startOfMonth()->toDateString());
    $date_fin = $request->input('date_fin', Carbon::now()->toDateString());

    // Récupération des ventes avec les relations client et livre
    $ventes = Vente::with(['livre', 'client'])
        ->whereBetween('date', [$date_debut, $date_fin])
        ->get();

    // Regrouper les ventes par client (en s'assurant que le client existe)
    $ventesParClient = $ventes->filter(function ($vente) {
            return $vente->client && $vente->livre;
        })
        ->groupBy(function ($vente) {
            return $vente->client->id;
        })
        ->map(function ($ventesClient) {
            $client = $ventesClient->first()->client;

            $total = $ventesClient->sum(function ($vente) {
                return $vente->livre ? $vente->livre->prix * $vente->quantite : 0;
            });

            return [
                'client' => $client,
                'ventes' => $ventesClient,
                'total' => $total,
            ];
        });

    // Total général des ventes (en vérifiant que le livre existe)
    $totalVentes = $ventes->sum(function ($vente) {
        return $vente->livre ? $vente->livre->prix * $vente->quantite : 0;
    });

    return view('ventes.ventesparclient', [
        'ventesParClient' => $ventesParClient,
        'data' => [
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
        ],
        'totalVentes' => $totalVentes,
    ]);
}



}

