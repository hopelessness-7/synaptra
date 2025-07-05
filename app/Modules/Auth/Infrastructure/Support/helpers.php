<?php

if (!function_exists('jsonError')) {
    function jsonError(string $code, string $message, int $status = 400, Throwable $e = null): \Illuminate\Http\JsonResponse {
        $traceId = Str::uuid()->toString();

        logger()->error("[$traceId] $code: $message", array_filter([
            'trace_id' => $traceId,
            'exception' => $e?->getMessage(),
            'stack' => $e?->getTraceAsString(),
        ]));

        return response()->json([
            'error' => [
                'code' => $code,
                'message' => $message,
                'trace_id' => $traceId,
            ]
        ], $status);
    }
}
