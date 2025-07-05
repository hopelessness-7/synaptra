<?php

namespace App\Modules\Auth\Application\UseCases\Auth;

use App\Models\User;
use App\Modules\Auth\Application\DTO\Auth\UserDeviceDTO;
use App\Modules\Auth\Application\DTO\Auth\UserRegisterDTO;
use App\Modules\Auth\Infrastructure\Repositories\Eloquent\UserDeviceRepository;
use App\Modules\Auth\Infrastructure\Utils\UserAgentParser;
use App\Repositories\Eloquent\UserRepository;

readonly class Register
{
    public function __construct(
        private UserRepository $userRepository,
        private UserDeviceRepository $userDeviceRepository,
    ){}

    public function execute(UserRegisterDTO $dto): User
    {
        $user = $this->userRepository->create($dto->forUserCreation());

        $deviceData = $dto->forDeviceCreation();
        $deviceName = UserAgentParser::parse($deviceData['userAgent']);

        $deviceDTO = UserDeviceDTO::fromArray([
            'user_id' => $user->id,
            'device_hash' => sha1($deviceName . '|' . $deviceData['ip']),
            'device_name' => $deviceName,
            'is_confirmed' => true,
            'last_used_at' => now(),
        ]);

        $this->userDeviceRepository->createFromDTO($deviceDTO);

        // Mail::to($user->email)->send(new ConfirmDeviceMail(...));

        return $user;
    }
}
