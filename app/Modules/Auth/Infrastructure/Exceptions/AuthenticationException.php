<?php

namespace Modules\Auth\Infrastructure\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class AuthenticationException extends Exception
{
    public function __construct(string $message = "",  int $code = 401)
    {
        parent::__construct($message,  $code);
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
