<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TicketCreated extends Notification
{
    use Queueable;

    protected $ticket;

    /**
     * Create a new notification instance.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // Notification par email et stockage dans la base
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouveau ticket créé')
            ->line('Un nouveau ticket a été créé.')
            ->line('Titre : ' . $this->ticket->titre)
            ->line('Description : ' . $this->ticket->description)
            ->action('Voir le ticket', route('tickets.show', $this->ticket->id))
            ->line('Merci de vérifier ce ticket dès que possible.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,
            'titre' => $this->ticket->titre,
            'description' => $this->ticket->description,
            'user_id' => $this->ticket->user_id,
        ];
    }
}
