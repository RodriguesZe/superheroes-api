<?php

namespace App\Services\Superheroes;

use App\Models\Superhero;
use App\Services\Search\SearchService;
use Illuminate\Support\Facades\Validator;

class SuperheroesService
{
    /**
     * @var Superhero
     */
    protected $superheroModel;

    /**
     * @var SearchService
     */
    protected $searchService;

    /**
     * SuperheroesService constructor.
     *
     * @param Superhero     $superheroModel
     * @param SearchService $searchService
     */
    public function __construct( Superhero $superheroModel, SearchService $searchService )
    {
        $this->superheroModel = $superheroModel;
        $this->searchService = $searchService;
    }

    /**
     * @param array $filters
     *
     * @return mixed
     */
    public function index(array $filters = [])
    {
        return \count($filters) === 0 ? $this->superheroModel->get() : $this->searchService->index($filters);
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
