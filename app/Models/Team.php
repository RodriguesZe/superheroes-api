<?php

namespace App\Models;

class Team extends BaseModel
{
    public $table = 'teams';

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