<?php

namespace Modules\Kanban\Infrastructure\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class BoardNotFoundException extends Exception
{
    public function __construct(string $message = "",  int $code = 404)
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
