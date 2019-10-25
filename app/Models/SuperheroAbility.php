<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

class SuperheroAbility extends BaseModel
{
    public $table = 'superhero_abilities';

    public $timestamps = false;

    protected $fillable = [
        'idSuperhero', 'idAbility',
    ];

    /**
     * The associated superhero.
     *
     * @return HasOne
     */
    public function superhero(): HasOne
    {
        return $this->hasOne(Superhero::class, 'id', 'idSuperhero');
    }

    /**
     * The associated ability.
     *
     * @return HasOne
     */
    public function ability(): HasOne
    {
        return $this->hasOne(Ability::class, 'id', 'idAbility');
    }
}
