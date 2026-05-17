<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;

class OuvrageController extends Controller
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
            $livre->image = $img_name;
        }
      

        $livre->save();
        return redirect('/gestionnaire');
        //return redirect()->back();

    }
    public function getLivres()
    {
        $livre = Livre::all();
        return view('editeurDashboard', compact('livre'));
    }



    //NOUVEAU DANY DÉBUT
    public function increment($id)
{
    $livre = Livre::findOrFail($id);
    $livre->stock++;
    $livre->save();
    return response()->json(['stock' => $livre->stock]);
}

public function decrement($id)
{
    $livre = Livre::findOrFail($id);
    if ($livre->stock > 0) {
        $livre->stock--;
        $livre->save();
    }
    return response()->json(['stock' => $livre->stock]);
}

    //ajout moi
    public function index()
    {
        $livre = Livre::all();
        return view('gestionnaireDashboard', compact('livre'));
    }

    public function rechercheParStock(Request $request)
    {
        $stock = $request->input('stock');
        $livre = Livre::where('stock', '>=', $stock)->get();
        return view('gestionnaireDashboard', compact('livre'));
    }

    public function edit($id)
    {

        $livre = Livre::findOrFail($id);
        return view('modifierOuvrage', compact('livre'));

    }

    public function update(Request $request, $id)
    {
        $livre = Livre::findOrFail($id);
    
        $livre->titre = $request->titre;
        $livre->stock = $request->stock;
        $livre->prix = $request->prix;
    
        if ($request->hasFile("image")) {
            $img = $request->file("image");
            $img_name = $img->getClientOriginalName();
            $img->move(public_path('assets/images'), $img_name);
            $livre->image = $img_name; 
        }
    
        $livre->save();
    
        return redirect()->route('livres.index')->with('success', 'Livre modifié avec succès');
    }
    

    public function destroy($id)
    {
        $livre = Livre::findOrFail($id);
    
        // Suppression du fichier image si nécessaire
        $imagePath = public_path('assets/images/' . $livre->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    
        $livre->delete();
    
        return redirect()->route('livres.index')->with('success', 'Livre supprimé avec succès');
    }
    



}
