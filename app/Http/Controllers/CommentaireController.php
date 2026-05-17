<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commentaire;
use App\Models\Livre;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Commentaire();
        $comment->contenu = $request->contenu;
        $comment->livre_id = $request->livre_id;
        $comment->client_id = $request->client_id;
        $comment->save();
        return redirect('/login');
    }
    // public function getCommentaires()
    // {
    //     $commentaires = Commentaire::where("statut", "en attente")->get();
    //     $clients = [];
    //     $livres = [];
    //     foreach ($commentaires as $com) {
    //         $client = Client::where('id', $com->client_id)->first();
    //         $livre = Livre::where('id', $com->livre_id)->first();
    //         $clients[$com->id] = $client;
    //         $livres[$com->id] = $livre;
    //     }
    //     return view('commentaire', compact('commentaires', 'clients', 'livres'));
    // }
    public function getCommentaires()
    {
        $commentaires = Commentaire::where("statut", "en attente")
            ->with(['client', 'livre'])
            ->get();

        return view('Editeur.commentaire', compact('commentaires'));
    }
    public function update($id, $status)
    {
        $com = Commentaire::findOrFail($id);
        $com->statut = $status;
        $com->save();
        return redirect('/commentaire');
    }
}
