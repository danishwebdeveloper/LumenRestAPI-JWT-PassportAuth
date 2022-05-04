<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Build Success Response
     *
     * @param String/array $data
     * @param int $code
     * @return Illuminate\Http\JsonResponse;
     */

    public function successResponse($data, $code = Response::HTTP_OK)
    {
        // We return real json response, change from normal MicroService API
        return response()->json(
            [
                'data' => $data,
            ],
            $code
        );
    }

    /**
     * Build Error Response
     *
     * @param String/array $message
     * @param int $code
     * @return Illuminate\Http\Response;
     */
    public function errorResponse($message, $code)
    {
        return response()->json(
            [
                'error' => $message,
                'code' => $code,
            ],
            $code
        );
    }
}