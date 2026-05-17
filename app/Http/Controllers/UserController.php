<?php

namespace App\Http\Controllers;

use App\Models\BackOfficeUtilisateur;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = new BackOfficeUtilisateur();
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->motDePasse = $request->motDePasse;
        $user->role = $request->role;
        $user->save();
        return redirect('/login');
    }
    public function getUser(Request $request)
    {
        $user = BackOfficeUtilisateur::where("email", $request->email)
            ->where("motDePasse", $request->password)
            ->firstOrFail();
        if ($user == null) {
            return redirect()->back();
        } else {
            if ($user->role == "editeur")
                return redirect("/editeur");
            elseif ($user->role == "gestionnaire")
                return redirect('/gestionnaire');
            else
                return redirect('/getusersImages');

        }

    }

    // les fonctions que safae ajoute cote admin
    public function getUsers()
    {

        $users = BackOfficeUtilisateur::all();
        return view('gererUtilisateurs', compact('users'));
    }

    public function destroy($id)
    {

        $user = BackOfficeUtilisateur::findOrFail($id);


        $imgpath = public_path('assets/images/' . $user->image);
        if (file_exists($imgpath)) {
            unlink($imgpath);
        }
        $user->delete();
        return redirect()->back();
    }

    // ajouter 
    public function AddUser(Request $request)
    {
        $user = new BackOfficeUtilisateur;
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->motDePasse = $request->motDePasse;
        $user->role = $request->role;
        // traitement d'image
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $nomphoto = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path("assets/images"), $nomphoto);
            $user->image = $nomphoto;
        } else {
            $user->image = null; // si j'ai pas d'image 
        }

        $user->save();
        return redirect()->back();
        //   return redirect()->back()->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function getUsersImages()
    {

        $users = BackOfficeUtilisateur::all();
        return view('adminDashboard', compact('users'));
    }

    public function showUser($id)
    {
        $user = BackOfficeUtilisateur::findOrFail($id);
        return view("/ModifierUser", compact("user"));
    }

    public function update(Request $request, $id)
    {
        // Récupère l'utilisateur à modifier
        $user = BackOfficeUtilisateur::findOrFail($id);

        // Met à jour les champs
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->motDePasse = $request->motDePasse;
        $user->role = $request->role;

        // Si une nouvelle image a été envoyée
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            $oldImagePath = public_path('assets/images/' . $user->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Récupère la nouvelle image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Déplace la nouvelle image dans le dossier public/assets/images
            $image->move(public_path('assets/images'), $imageName);

            // Met à jour le nom de l'image dans la BDD
            $user->image = $imageName;
        }


        // Sauvegarde dans la BDD
        $user->save();

        // Redirection avec message de succès
        return redirect()->route('gererUtilisateurs')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // chercher 
    public function search(Request $request)
    {
        $searchTerm = $request->input('nom');

        $users = BackOfficeUtilisateur::where('nom', 'LIKE', '%' . $searchTerm . '%')->get();

        return view('gererUtilisateurs', compact('users'));
    }

    // mdifier role:
    public function modifierRole(Request $request, $id)
    {
        // Si la requête est JSON (via fetch), utiliser json() au lieu de input()
        $role = $request->input('role') ?? $request->json('role');

        if (!$role) {
            return response()->json(['error' => 'Le rôle est requis.'], 400);
        }

        $user = BackOfficeUtilisateur::findOrFail($id);
        $user->role = $role;
        $user->save();

        return response()->json(['message' => 'Rôle modifié avec succès.']);
    }
}
