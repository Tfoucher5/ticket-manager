<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite query()
 * @mixin \Eloquent
 */
class Priorite extends Model
{
    protected $fillable = ['libelle'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
