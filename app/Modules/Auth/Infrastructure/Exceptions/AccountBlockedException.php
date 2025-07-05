<?php

namespace Modules\Auth\Infrastructure\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class AccountBlockedException extends Exception
{
    public function __construct(string $message = "",  int $code = 403)
    {
        parent::__construct($message, $code);
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
