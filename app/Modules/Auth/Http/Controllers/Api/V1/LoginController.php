<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1;

use App\Http\Controllers\MainApiController;
use App\Modules\Auth\Application\DTO\Auth\LoginDTO;
use App\Modules\Auth\Application\UseCases\Auth\Login;
use App\Modules\Auth\Infrastructure\Exceptions\DeviceNotConfirmedException;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Resources\UserResource;
use Modules\Auth\Infrastructure\Exceptions\AccountBlockedException;
use Modules\Auth\Infrastructure\Exceptions\AuthenticationException;

class LoginController extends MainApiController
{

    public function __construct(
        private readonly Login $login
    ) {}

    /**
     * @throws AuthenticationException|AccountBlockedException|DeviceNotConfirmedException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $dto = LoginDTO::fromArray([
            ...$request->validated(),
            'userAgent' => $request->userAgent(),
            'ip' => $request->ip()
        ]);

        $data = $this->login->execute($dto);

        return $this->success([
            ...UserResource::make($data['user'])->toArray($request),
            'message' => 'Successfully logged in'
        ])->cookie('token', $data['token']);
    }
}
