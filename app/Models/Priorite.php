<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $libelle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Priorite whereUpdatedAt($value)
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
