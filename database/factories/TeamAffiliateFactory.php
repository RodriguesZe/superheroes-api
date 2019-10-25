<?php

use App\Models\Superhero;
use App\Models\Team;
use App\Models\TeamAffiliate;

$factory->define(TeamAffiliate::class, function (Faker\Generator $faker) {
    return [
        'idSuperhero'        => function () {
            return factory(Superhero::class)->create()->id;
        },
        'idTeam'         => function () {
            return factory(Team::class)->create()->id;
        },
    ];
});
