<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NouveauCommentaireNotification;

class CommentaireController extends Controller
{
    // Méthode pour ajouter un commentaire
    public function store(Request $request, Ticket $ticket)
    {
        // Valider le contenu du commentaire
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        // Créer un nouveau commentaire
        $commentaire = new Commentaire();
        $commentaire->contenu = $request->contenu;
        $commentaire->ticket_id = $ticket->id;
        $commentaire->user_id = auth()->id();

        // Vérification et stockage du fichier si présent
        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $filePath = $file->store();
            $commentaire->fichier_path = $filePath;
        }

        $commentaire->save();

        if (auth()->user()->isA('developpeur'))
        {
            $client = User::where('id', $ticket->user_id)->first();
            if ($client) {
                $client->notify(new NouveauCommentaireNotification($commentaire));
            }

        } elseif (auth()->user()->isA('client'))
        {
            $developpeur = User::where('id', $ticket->developpeur_id)->first();
            if ($developpeur) {
                $developpeur->notify(new NouveauCommentaireNotification($commentaire));
            }
        }

        // Rediriger vers la page du ticket avec un message de succès
        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Commentaire ajouté avec succès.');
    }
}
