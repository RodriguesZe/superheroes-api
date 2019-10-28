<?php

namespace App\Http\Controllers;

use App\Services\Superheroes\SuperheroesService;
use Illuminate\Http\JsonResponse;

class WelcomeController extends BaseController
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
     * Welcome endpoint.
     *
     */
    public function index(): JsonResponse
    {
        $superHeroes = $this->service->index();

        $superHero = $superHeroes->first();

        return response()->json([
            'Welcome'   => 'Superheroes API!',
            'Examples' => [
                'list'      => [
                    'verb' => 'GET',
                    'endpoint' => env('APP_URL').'/superheroes',
                ],
                'search'     => [
                    'verb' => 'GET',
                    'endpoint' => env('APP_URL').'/superheroes?name='.str_replace(' ', '%20', $superHero->heroName),
                ],
                'show'       => [
                    'verb' => 'GET',
                    'endpoint' => env('APP_URL').'/superheroes/'.$superHero->id,
                ],
                'update'     => [
                    'verb' => 'PUT',
                    'endpoint' => env('APP_URL').'/superheroes/'.$superHero->id,
                ],
            ]
        ], 200);
    }
}
