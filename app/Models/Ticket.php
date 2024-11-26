<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property-read \App\Models\Categorie|null $categorie
 * @property-read \App\Models\Priorite|null $priorite
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket query()
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'category_id', 'priority_id', 'status', 'developer_id'];

    public function user()
    {
        return $this->belongsTo(User::class); // Un ticket appartient à un client
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id'); // Un ticket peut être affecté à un développeur
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class); // Un ticket a une catégorie
    }

    public function priorite()
    {
        return $this->belongsTo(Priorite::class); // Un ticket a une priorité
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class); // Un ticket peut avoir plusieurs commentaires
    }
}
