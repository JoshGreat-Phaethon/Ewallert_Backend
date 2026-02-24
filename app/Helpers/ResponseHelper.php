<?php
namespace App\Helpers;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    public static function success(
        mixed $data = null,
        string $message = 'OK',
        int $code = Response::HTTP_OK
    ): JsonResponse {
        return response()->json([
            'meta' => [
                'code' => $code,
                'status' => 'success',
                'message' => $message,
            ],
            'data' => $data
        ],$code );
    }
    public static function paginate(
        $paginator,
        string $message = 'OK',
        int $code = Response::HTTP_OK
    ): JsonResponse {
        return response()->json([
            'meta' => [
                'code' => $code,
                'status' => 'success',
                'message' => $message,
                'pagination' => [
                    'current_page' => $paginator->currentPage(),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'last_page' => $paginator->lastPage(),
                ],
            ],
            'data' => $paginator->items(),
        ], $code);
    }
    public static function error(
        string $message,
        int $code = Response::HTTP_BAD_REQUEST,
        mixed $data = null
    ): JsonResponse {
        return response()->json([
            'meta' => [
                'code' => $code,
                'status' => 'error',
                'message' => $message,
            ],
        ], $code);
    }
}