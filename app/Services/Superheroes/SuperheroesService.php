<?php

namespace App\Services\Superheroes;

use App\Models\Superhero;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Show the desired superhero.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function show(string $id)
    {
        return $this->superheroModel->findOrFail($id);
    }

    /**
     * Update the desired superhero.
     *
     * @param string $id
     * @param array  $data
     *
     * @return mixed
     */
    public function update(string $id, array $data)
    {
        $rules = $this->superheroModel->updateRules;

        $validator = Validator::make($data, $rules);
        $validator->validate();
        
        $superhero = $this->show($id);
        return $superhero->update($data);
    }
}
