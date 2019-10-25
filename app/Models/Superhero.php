<?php

namespace App\Models;

class Superhero extends BaseModel
{
    public $table = 'superheroes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'realName', 'heroName', 'publisher', 'firstAppearance',
    ];

    protected $guarded = ['created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'firstAppearance' => 'datetime',
    ];
}