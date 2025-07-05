<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1;

use App\Http\Controllers\MainApiController;
use App\Modules\Auth\Application\DTO\Auth\UserRegisterDTO;
use App\Modules\Auth\Application\UseCases\Auth\Register;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Http\Requests\RegisterRequest;

class RegisterController extends MainApiController
{
    public function __construct(
        private readonly Register $register
    ){}

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $dto = UserRegisterDTO::fromArray([
            ...$request->validated(),
            'userAgent' => $request->userAgent(),
            'ipAddress' => $request->ip(),
        ]);

        $this->register->execute($dto);

        return $this->success([
            'message' => 'Go through the authorization process'
        ], 201);
    }
}
