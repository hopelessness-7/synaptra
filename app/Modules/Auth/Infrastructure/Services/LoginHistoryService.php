<?php

namespace App\Modules\Auth\Infrastructure\Services;

use App\Models\User;
use App\Modules\Auth\Application\DTO\Auth\LoginHistoryDTO;
use App\Modules\Auth\Infrastructure\Repositories\Eloquent\LoginHistoryRepository;
use App\Modules\Auth\Infrastructure\Utils\UserAgentParser;
use Carbon\Carbon;

final class LoginHistoryService
{
    public function __construct(
        protected LoginHistoryRepository $loginHistoryRepository,
    ){}

    public function logLogin(User $user): void
    {
        $dto = LoginHistoryDTO::fromArray([
            'user_id' => $user->id,
            'ip_address' => request()->ip(),
            'user_agent' =>  request()->userAgent(),
            'logged_in_at' => Carbon::now()->toDateTimeString(),
            'device_name' =>  UserAgentParser::parse(request()->userAgent()),
        ]);

        $this->loginHistoryRepository->createFromDTO($dto);
    }
}
