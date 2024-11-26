<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'contenu' => 'required|string|max:2000',
            'fichier' => 'nullable|file|mimes:jpg,png,pdf,docx,xlsx|max:2048',
        ]);

        $fichierPath = $request->file('fichier')
            ? $request->file('fichier')->store('commentaires')
            : null;

        $commentaire = $ticket->commentaires()->create([
            'contenu' => $request->contenu,
            'auteur_id' => auth()->id(),
            'fichier' => $fichierPath,
        ]);

        $destinataire = $ticket->developpeur_id && auth()->id() === $ticket->developpeur_id
            ? $ticket->client
            : $ticket->developpeur;

        if ($destinataire) {
            $destinataire->notify(new NouveauCommentaireNotification($commentaire));
        }

        return redirect()->route('tickets.show', $ticket)->with('success', 'Commentaire ajouté avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}
