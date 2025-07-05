<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1;

use App\Http\Controllers\MainApiController;
use App\Modules\Auth\Application\UseCases\Auth\Logout;
use Illuminate\Http\JsonResponse;

class LogoutController extends MainApiController
{
    public function __construct(
        private readonly Logout $logout
    ){}

    public function __invoke(): JsonResponse
    {
        $this->logout->execute();

        return $this->success([
            'message' => 'Successfully logged out'
        ], 201);
    }
}
