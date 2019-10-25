<?php

namespace App\Models;

class SuperheroAbility extends BaseModel
{
    public $table = 'superhero_abilities';

    public $timestamps = false;

    protected $fillable = [
        'idSuperhero', 'idAbility',
    ];
}