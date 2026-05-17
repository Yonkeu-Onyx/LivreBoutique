<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\CategorieLivre;
use App\Models\Livre;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function store(Request $request)
    {
        $categorie = new Categorie();
        $categorie->nom = $request->nom;
        $categorie->save();

        $cat = $categorie;

        $livres = [];
        $livres = $request->livres;
        if (!empty($livres)) {
            foreach ($livres as $lv) {
                $categorieLivre = new CategorieLivre();
                $categorieLivre->id_categorie = $cat->id;
                $categorieLivre->id_livre = $lv;
                $categorieLivre->save();
            }
        }
        return redirect('/categorie');
    }
    public function getCategories()
    {
        $categories = Categorie::all();
        $livsCats = [];

        foreach ($categories as $cats) {
            $livsCat = [];
            $livcats = CategorieLivre::where('id_categorie', $cats->id)->get();
            if ($livcats->isNotEmpty()) {
                foreach ($livcats as $lc) {
                    $liv = Livre::findOrFail($lc->id_livre);
                    if ($liv) {
                        $livsCat[] = $liv;
                    }
                }
                $livsCats[$cats->id] = $livsCat;
            }
        }
        return view('Editeur.categories', compact('categories', 'livsCats'));
    }
    public function getCategoriesWelcome()
    {
        $categories = Categorie::all();
        $livsCats = [];

        foreach ($categories as $cats) {
            $livsCat = [];
            $livcats = CategorieLivre::where('id_categorie', $cats->id)->get();
            if ($livcats->isNotEmpty()) {
                foreach ($livcats as $lc) {
                    $liv = Livre::findOrFail($lc->id_livre);
                    if ($liv) {
                        $livsCat[] = $liv;
                    }
                }
                $livsCats[$cats->id] = $livsCat;
            }
        }
        return view('welcome', compact('categories', 'livsCats'));
    }
    public function getCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorieLivre_Ids = CategorieLivre::where('id_categorie', $categorie->id)->get();
        $livresCategorie = [];
        if ($categorieLivre_Ids->isNotEmpty()) {
            foreach ($categorieLivre_Ids as $catLivId) {
                $livre = Livre::findOrFail($catLivId->id_livre);
                if ($livre) {
                    $livresCategorie[] = $livre;
                }
            }
        }
        $otherLivres = [];
        if (!empty($livresCategorie)) {
            $idsToReject = collect($livresCategorie)->pluck('id')->toArray();
            $otherLivres = Livre::whereNotIn('id', $idsToReject)->get();
        }
        return view('Editeur.editerCategorie', compact('categorie', 'livresCategorie', 'otherLivres'));

    }
    public function addLivre(Request $request)
    {
        $livres = $request->livres;
        if (!empty($livres)) {
            foreach ($livres as $lv) {
                $categorieLivre = new CategorieLivre();
                $categorieLivre->id_livre = $lv;
                $categorieLivre->id_categorie = $request->id;
                $categorieLivre->save();
            }
        }
        return redirect('/categorie');
    }
    public function DelLivre(Request $request)
    {
        $livres = $request->livres;
        if (!empty($livres)) {
            foreach ($livres as $id) {
                $categorieLivre = CategorieLivre::where("id_livre", $id)
                    ->where('id_categorie', $request->id)
                    ->firstOrFail();
                $categorieLivre->delete();
            }
        }
        return redirect('/categorie');

    }

    public function delete(Request $request)
    {
        CategorieLivre::where("id_categorie", $request->id)->delete();
        $categorie = Categorie::findOrFail($request->id);
        $categorie->delete();
        return redirect('/categorie');
    }

}
