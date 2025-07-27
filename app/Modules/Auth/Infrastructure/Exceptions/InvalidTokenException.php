<?php

namespace Modules\Auth\Infrastructure\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidTokenException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid or revoked token', 401);
    }


}
