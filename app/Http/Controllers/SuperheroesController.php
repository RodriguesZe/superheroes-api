<?php

namespace App\Http\Controllers;

use App\Http\Resources\Superheroes as SuperheroesResource;
use App\Services\Superheroes\SuperheroesService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

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
     * List all superheroes (includes filters).
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->service->index($request->all());

        return SuperheroesResource::collection($result);
    }

    /**
     * Show the desired superhero.
     *
     * @param string $id
     *
     * @return SuperheroesResource|array
     */
    public function show(string $id)
    {
        try
        {
            $result = $this->service->show($id);

            return SuperheroesResource::make($result);
        }
        catch( ModelNotFoundException $exception )
        {
            return response()->json(['message' => 'Superhero not found.'], 404);
        }
    }

    /**
     * Update the desired superhero.
     *
     * @param Request $request
     * @param string  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( Request $request, string $id ): \Illuminate\Http\JsonResponse
    {
        try
        {
            $result = $this->service->update($id, $request->toArray());

            return response()->json(null, 204);
        }
        catch (ValidationException $validationException)
        {
            $message = [
                'message'   => 'Validation failed.',
                'errors'    => $validationException->errors(),
            ];

            return response()->json($message, 422);
        }
        catch( ModelNotFoundException $exception )
        {
            return response()->json(['message' => 'Superhero not found.'], 404);
        }
    }
}
