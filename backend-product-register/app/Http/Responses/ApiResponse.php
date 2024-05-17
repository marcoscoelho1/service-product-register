<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Success response.
     *
     * @param mixed $data
     * @param int $status
     * @param string|null $message
     * @return JsonResponse
     */
    public static function success($data, int $status = 200, string $message = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Error response.
     *
     * @param string $message
     * @param int $status
     * @param mixed $errors
     * @return JsonResponse
     */
    public static function error(string $message, int $status = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
