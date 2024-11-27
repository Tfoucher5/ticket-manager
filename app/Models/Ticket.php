<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $titre
 * @property string $description
 * @property int $categorie_id
 * @property int $priorite_id
 * @property string $statut
 * @property int|null $developpeur_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Categorie $categorie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Commentaire> $commentaires
 * @property-read int|null $commentaires_count
 * @property-read \App\Models\User|null $developer
 * @property-read \App\Models\Priorite $priorite
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCategorieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereDeveloppeurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket wherePrioriteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUserId($value)
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
