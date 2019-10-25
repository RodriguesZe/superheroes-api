<?php

namespace App\Models;

class Ability extends BaseModel
{
    public $table = 'abilities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    protected $guarded = ['created_at', 'updated_at'];
}