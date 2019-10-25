<?php

use App\Models\Ability;
use Illuminate\Database\Seeder;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $abilities = factory(Ability::class, 10)->create();
    }
}
