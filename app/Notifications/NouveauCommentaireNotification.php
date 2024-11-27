<?php

namespace App\Notifications;

use App\Models\Commentaire;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NouveauCommentaireNotification extends Notification
{
    protected $commentaire;

    public function __construct(Commentaire $commentaire)
    {
        $this->commentaire = $commentaire;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $ticket = $this->commentaire->ticket;
        $url = route('tickets.show', $ticket->id);

        return (new MailMessage)
            ->subject("Nouveau commentaire sur le ticket : {$ticket->titre}")
            ->greeting("Bonjour {$notifiable->name},")
            ->line("Un nouveau commentaire a été ajouté par {$this->commentaire->user->name}.")
            ->line("Commentaire : {$this->commentaire->contenu}")
            ->action('Voir le ticket', $url)
            ->line("Merci de consulter le ticket pour plus de détails.");
    }
}
