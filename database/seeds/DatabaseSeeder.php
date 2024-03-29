<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(SuperheroesTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(AbilitiesTableSeeder::class);
        $this->call(TeamAffiliatesTableSeeder::class);
        $this->call(SuperheroesAbilitiesTableSeeder::class);
    }
}
