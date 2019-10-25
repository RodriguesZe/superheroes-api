<?php

use App\Models\Superhero;
use Illuminate\Database\Seeder;

class SuperheroesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $superheroes = factory(Superhero::class, 5)->create();
    }
}
