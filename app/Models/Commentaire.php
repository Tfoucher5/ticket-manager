<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property string $contenu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ticket $ticket
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereUserId($value)
 * @mixin \Eloquent
 */
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
