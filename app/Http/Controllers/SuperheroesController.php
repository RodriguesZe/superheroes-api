<?php

namespace App\Http\Controllers;

use App\Http\Resources\Superheroes as SuperheroesResource;
use App\Services\Superheroes\SuperheroesService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SuperheroesController
{
    /**
     * @var SuperheroesService
     */
    protected $service;

    /**
     * SuperheroesController constructor.
     *
     * @param SuperheroesService $service
     */
    public function __construct(SuperheroesService $service)
    {
        $this->service = $service;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $result = $this->service->index();

        return SuperheroesResource::collection($result);
    }
}
