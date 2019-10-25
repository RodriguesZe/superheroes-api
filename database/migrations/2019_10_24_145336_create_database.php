<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('superheroes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('realName');
            $table->string('heroName')->unique();
            $table->string('publisher');
            $table->date('firstAppearance')->nullable();
            $table->timestamps();
        });

        Schema::create('abilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('superhero_abilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('idSuperhero');
            $table->uuid('idAbility');

            $table->foreign('idSuperhero')->references('id')->on('superheroes');
            $table->foreign('idAbility')->references('id')->on('abilities');
        });

        Schema::create('team_affiliations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('idTeam');
            $table->uuid('idSuperhero');

            $table->foreign('idTeam')->references('id')->on('teams');
            $table->foreign('idSuperhero')->references('id')->on('superheroes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('team_affiliations');
        Schema::dropIfExists('superhero_abilities');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('abilities');
        Schema::dropIfExists('superheroes');
    }
}
