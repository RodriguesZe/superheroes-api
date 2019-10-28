<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class WelcomeController extends BaseController
{
    /**
     * Welcome endpoint.
     *
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'Welcome'   => 'Superheroes API!',
            'Examples' => [
                'list'      => [
                    'verb' => 'GET',
                    'endpoint' => env('APP_URL').'/superheroes',
                ],
                'search'     => [
                    'verb' => 'GET',
                    'endpoint' => env('APP_URL').'/superheroes?name=lreinger',
                ],
                'show'       => [
                    'verb' => 'GET',
                    'endpoint' => env('APP_URL').'/superheroes/06288f49d53349d7b6765c7d8b1eecbb',
                ],
                'update'     => [
                    'verb' => 'PUT',
                    'endpoint' => env('APP_URL').'/superheroes/06288f49d53349d7b6765c7d8b1eecbb',
                ],
            ]
        ], 200);
    }
}
