<?php

use App\Models\TeamAffiliate;
use Illuminate\Database\Seeder;

class TeamAffiliatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $superheroes = \DB::table('superheroes')->select('id')->get();
        $teams = \DB::table('teams')->select('id')->get();

        foreach ($superheroes as $superhero)
        {
            // get and remove the first element from the collection
            // in order to keep the collection with only unused values.
            $team = $teams->shift();
            
            $superheroTeam = factory(TeamAffiliate::class)->create([
                'idSuperhero'   => $superhero->id,
                'idTeam'        => $team->id,
            ]);
        }
    }
}
