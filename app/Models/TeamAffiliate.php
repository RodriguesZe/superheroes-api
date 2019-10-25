<?php

namespace App\Models;

class TeamAffiliate extends BaseModel
{
    public $table = 'team_affiliations';

    public $timestamps = false;

    protected $fillable = [
        'idTeam', 'idSuperhero',
    ];
}
