<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function store(Request $request)
    {
        $livre = new Livre();
        $livre->titre = $request->titre;
        $livre->stock = $request->stock;
        $livre->prix = $request->prix;
        // $img_name = "";
        if ($request->hasFile("image")) {
            $img = $request->file("image");
            $img_name = $img->getClientOriginalName();
            $img->move(public_path('assets/images'), $img_name);
        }
        $livre->image = $img_name;

        $livre->save();
        return redirect('/login');


    }
    public function getLivres()
    {
        $livre = Livre::all();
        return view('Editeur.editeurDashboard', compact('livre'));
    }
    public function getLivresCat()
    {
        $livre = Livre::all();
        return view('Editeur.addCategorie', compact('livre'));
    }
    public function editLivre($id)
    {
        $livre = Livre::findOrFail($id);
        return view('Editeur.editerLivre', compact('livre'));
    }
    public function update(Request $request, $id)
    {
        $livre = Livre::findOrFail($id);
        $livre->description = $request->description;
        $livre->niveauExpertise = $request->expertise;
        $livre->save();
        return redirect('/editeur');
    }
}
