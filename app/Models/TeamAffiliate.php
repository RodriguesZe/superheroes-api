<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

class TeamAffiliate extends BaseModel
{
    public $table = 'team_affiliations';

    public $timestamps = false;

    protected $fillable = [
        'idTeam', 'idSuperhero',
    ];

    /**
     * The associated team.
     *
     * @return HasOne
     */
    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'idTeam');
    }

    /**
     * The associated superhero.
     *
     * @return HasOne
     */
    public function superhero(): HasOne
    {
        return $this->hasOne(Superhero::class, 'id', 'idSuperhero');
    }
}
