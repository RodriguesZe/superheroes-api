<?php

namespace App\Http\Controllers;

use App\Http\Resources\Superheroes as SuperheroesResource;
use App\Services\Superheroes\SuperheroesService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class SuperheroesController extends BaseController
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
     * @return SuperheroesResource|\Illuminate\Http\JsonResponse
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
            return $this->returnErrorResponse(404, 'Superhero not found.');
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
            return $this->returnValidationErrorResponse($validationException->errors());
        }
        catch( ModelNotFoundException $exception )
        {
            return $this->returnErrorResponse(404, 'Superhero not found.');
        }
    }
}
