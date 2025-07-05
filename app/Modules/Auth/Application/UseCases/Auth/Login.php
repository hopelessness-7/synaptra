<?php

namespace App\Modules\Auth\Application\UseCases\Auth;

use App\Modules\Auth\Application\DTO\Auth\DeviceConfirmationDTO;
use App\Modules\Auth\Application\DTO\Auth\LoginDTO;
use App\Modules\Auth\Infrastructure\Exceptions\DeviceNotConfirmedException;
use App\Modules\Auth\Infrastructure\Services\DeviceConfirmationService;
use App\Modules\Auth\Infrastructure\Services\LoginHistoryService;
use App\Modules\Auth\Infrastructure\Services\LoginRateLimiterService;
use App\Modules\Auth\Infrastructure\Utils\JwtTokenFactory;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Infrastructure\Exceptions\AccountBlockedException;
use Modules\Auth\Infrastructure\Exceptions\AuthenticationException;

readonly class Login
{
    public function __construct(
        private UserRepository $userRepository,
        private LoginRateLimiterService  $loginRateLimiterService,
        private DeviceConfirmationService $deviceConfirmationService,
        private LoginHistoryService $loginHistoryService,
    ){}

    /**
     * @param LoginDTO $dto
     * @return array
     * @throws AuthenticationException|AccountBlockedException|DeviceNotConfirmedException
     */
    public function execute(LoginDTO $dto): array
    {
        $user = $this->userRepository->where('email', $dto->email)->queryFirst();

        if (!$user) {
            throw new AuthenticationException("Invalid email", 403);
        }

        if ($this->userRepository->isBlocked($user->id)) {
            throw new AccountBlockedException('Your account has been blocked. Contact support', 403);
        }

        if ($this->userRepository->requiresReAuth($user->id)) {
            $this->userRepository->setActive($user->id);
        }

        $this->loginRateLimiterService->ensureNotBlocked($user->email);

        if (!Hash::check($dto->password, $user->password)) {
            $this->loginRateLimiterService->handle($user->email);
            throw new AuthenticationException("Invalid password", 401);
        }

        $this->loginRateLimiterService->clearAttempts($user->email);

        $deviceDTO = DeviceConfirmationDTO::fromArray([
            'ip' => $dto->ip,
            'userAgent' => $dto->userAgent,
        ]);

        $this->deviceConfirmationService->handleDevice($user, $deviceDTO);

        $this->loginHistoryService->logLogin($user);

        return [
            'user'  => $user,
            'token' => JwtTokenFactory::makeForUser($user)
        ];
    }
}
