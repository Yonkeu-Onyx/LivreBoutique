<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $client = new Client();
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->motDePasse = $request->motDePasse;
        $client->email = $request->email;
        $client->save();
        return redirect('/login');
    }
}
