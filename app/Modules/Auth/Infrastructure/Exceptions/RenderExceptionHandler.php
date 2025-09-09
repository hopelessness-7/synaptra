<?php

namespace App\Modules\Auth\Infrastructure\Exceptions;

use Illuminate\Http\JsonResponse;
use Modules\Auth\Infrastructure\Exceptions\AccountBlockedException;
use Modules\Auth\Infrastructure\Exceptions\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class RenderExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $e): JsonResponse|Response
    {
        $code = $this->resolveHttpCode($e);

        return match (true) {
            $e instanceof DeviceNotConfirmedException => jsonError('DEVICE_NOT_CONFIRMED', $e->getMessage(), $code, $e),
            $e instanceof AccountBlockedException     => jsonError('ACCOUNT_BLOCKED', $e->getMessage(), $code, $e),
            $e instanceof AuthenticationException     => jsonError('AUTHENTICATION_FAILED', $e->getMessage(), $code, $e),
            default                                   => jsonError('INTERNAL_SERVER_ERROR', $e->getMessage(), $code, $e),
        };
    }

    private function resolveHttpCode(Throwable $e): int
    {
        $code = $e->getCode();

        return is_int($code) && $code >= 100 && $code <= 599 ? $code : 500;
    }
}

