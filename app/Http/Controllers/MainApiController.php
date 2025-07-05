<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class MainApiController extends Controller
{
    protected function success(array $data = [], int $status = 200, array $headers = [], array $cookies = []): JsonResponse
    {
        $response = response()->json(['code' => 'SUCCESSFUL', ...$data], $status, $headers);

        foreach ($cookies as $cookie) {
            $response->withCookie($cookie);
        }

        return $response;
    }

    protected function error(string $code, string $message, int $status = 400, array $errors = [], array $headers = []): JsonResponse
    {
        return response()->json([
            'code'    => $code,
            'message' => $message,
            'errors'  => $errors
        ], $status, $headers);
    }
}
