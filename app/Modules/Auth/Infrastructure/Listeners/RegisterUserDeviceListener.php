<?php

namespace Modules\Auth\Infrastructure\Listeners;

use App\Modules\Auth\Application\DTO\Auth\UserDeviceDTO;
use App\Modules\Auth\Infrastructure\Repositories\Eloquent\UserDeviceRepository;
use App\Modules\Auth\Infrastructure\Utils\UserAgentParser;
use Modules\Auth\Infrastructure\Events\UserRegisteredEvent;

class RegisterUserDeviceListener
{
    public function __construct(
        private readonly UserDeviceRepository $devices
    ){}

    public function handle(UserRegisteredEvent $event): void
    {
        $deviceName = UserAgentParser::parse(request()->userAgent());

        $deviceDTO = UserDeviceDTO::fromArray([
            'user_id' => $event->user->id,
            'device_hash' => sha1($deviceName . '|' . request()->ip()),
            'device_name' => $deviceName,
            'is_confirmed' => true,
            'last_used_at' => now(),
        ]);

        $this->devices->createFromDTO($deviceDTO);
    }
}

