<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    /**
     * @param int    $errorCode
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function returnErrorResponse(int $errorCode = 404, string $message = 'Result not found.'): JsonResponse
    {
        return response()->json(['message' => $message], $errorCode);
    }

    /**
     * @param array $errors
     *
     * @return JsonResponse
     */
    protected function returnValidationErrorResponse(array $errors = []): JsonResponse
    {
        $message = [
            'message'   => 'Validation failed.',
            'errors'    => $errors,
        ];

        return response()->json($message, 422);
    }
}
