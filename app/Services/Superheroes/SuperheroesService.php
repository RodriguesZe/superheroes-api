<?php

namespace App\Services\Superheroes;

use App\Models\Superhero;

class SuperheroesService
{
    /**
     * @var Superhero
     */
    protected $superheroModel;

    /**
     * SuperheroesService constructor.
     *
     * @param Superhero $superheroModel
     */
    public function __construct( Superhero $superheroModel )
    {
        $this->superheroModel = $superheroModel;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->superheroModel->get();
    }
}
