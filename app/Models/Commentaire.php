<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = ['ticket_id', 'user_id', 'comment'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class); // Un commentaire appartient à un ticket
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Un commentaire appartient à un utilisateur
    }

}
