<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ];

        if ($data instanceof LengthAwarePaginator) {
            $response['pagination'] = [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage(),
            ];
            $response['data'] = $data->items();
        }

        return response()->json($response, $status);
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
