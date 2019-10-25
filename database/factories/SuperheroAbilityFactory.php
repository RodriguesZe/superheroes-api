<?php

use App\Models\Ability;
use App\Models\Superhero;
use App\Models\SuperheroAbility;

$factory->define(SuperheroAbility::class, function (Faker\Generator $faker) {
    return [
        'idSuperhero'        => function () {
            return factory(Superhero::class)->create()->id;
        },
        'idAbility'         => function () {
            return factory(Ability::class)->create()->id;
        },
    ];
});
