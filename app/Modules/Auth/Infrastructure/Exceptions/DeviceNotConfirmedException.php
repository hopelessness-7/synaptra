<?php

namespace App\Modules\Auth\Infrastructure\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class DeviceNotConfirmedException extends Exception
{
    public function __construct(string $message = "Подтвердите новое устройство для входа.", $code = 403)
    {
        parent::__construct($message, $code);
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'error' => 'device_not_confirmed'
        ], $this->getCode());
    }

}
