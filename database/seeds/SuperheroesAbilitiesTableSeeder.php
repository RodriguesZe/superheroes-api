<?php

use App\Models\SuperheroAbility;
use Illuminate\Database\Seeder;

class SuperheroesAbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $superheroes = \DB::table('superheroes')->select('id')->get();
        $abilities = \DB::table('abilities')->select('id')->get();

        foreach ($superheroes as $superhero)
        {
            // get and remove the first element from the collection
            // in order to keep the collection with only unused values.
            $ability = $abilities->shift();
            $ability2 = $abilities->shift();

            $superheroAbility = factory(SuperheroAbility::class)->create([
                'idSuperhero'   => $superhero->id,
                'idAbility'     => $ability->id,
            ]);

            $superheroAbility2 = factory(SuperheroAbility::class)->create([
                'idSuperhero'   => $superhero->id,
                'idAbility'     => $ability2->id,
            ]);
        }
    }
}
