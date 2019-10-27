<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Superhero extends BaseModel
{
    public $table = 'superheroes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'realName', 'heroName', 'publisher', 'firstAppearance',
    ];

    protected $guarded = ['created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'firstAppearance' => 'datetime',
    ];

    public $updateRules = [
        'realName' => ['string', 'max:255'],
        'heroName' => ['string', 'max:255', 'unique:users'],
        'publisher' => ['string', 'max:255'],
        'firstAppearance' => ['date'],
    ];

    /**
     * The abilities that a superhero has.
     *
     * @return HasMany
     */
    public function abilities(): HasMany
    {
        return $this->hasMany(SuperheroAbility::class, 'idSuperhero');
    }

    /**
     * The team affiliations that a superhero has.
     *
     * @return HasMany
     */
    public function affiliations(): HasMany
    {
        return $this->hasMany(TeamAffiliate::class, 'idSuperhero');
    }
}
