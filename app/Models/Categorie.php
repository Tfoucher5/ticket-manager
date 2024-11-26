<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie query()
 * @mixin \Eloquent
 */
class Categorie extends Model
{
    protected $fillable = ['libelle'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
