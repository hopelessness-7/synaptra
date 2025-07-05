<?php

namespace App\Modules\Auth\Infrastructure\Services;

use App\Models\User;
use App\Modules\Auth\Application\DTO\Auth\DeviceConfirmationDTO;
use App\Modules\Auth\Application\DTO\Auth\UserDeviceDTO;
use App\Modules\Auth\Domain\Contracts\DeviceConfirmationServiceInterface;
use App\Modules\Auth\Infrastructure\Exceptions\DeviceNotConfirmedException;
use App\Modules\Auth\Infrastructure\Repositories\Eloquent\UserDeviceRepository;
use App\Modules\Auth\Infrastructure\Utils\UserAgentParser;

final class DeviceConfirmationService implements DeviceConfirmationServiceInterface
{
    public function __construct(
        private readonly UserDeviceRepository $userDeviceRepository,
    ){}

    /**
     * @throws DeviceNotConfirmedException
     */
    public function handleDevice(User $user, DeviceConfirmationDTO $deviceDTO): void
    {
        $deviceHash = $this->generateDeviceHash($deviceDTO);

        $device = $this->userDeviceRepository->where('user_id', $user->id)
            ->where('device_hash', $deviceHash)->queryFirst();

        if ($device && $device->is_confirmed) {
            $this->userDeviceRepository->update($device->id, ['last_used_at' => now()]);
            return;
        }

        if (!$device) {
            $userDeviceDTO = UserDeviceDTO::fromArray([
                'user_id' => $user->id,
                'device_hash' => $deviceHash,
                'device_name' => $this->parseDeviceName($deviceDTO->userAgent),
                'is_confirmed' => false,
                'last_used_at' => now(),
            ]);

            $this->userDeviceRepository->createFromDTO($userDeviceDTO);
        }

        // Здесь можно отправить email или Telegram сообщение
        // Mail::to($user->email)->send(new ConfirmDeviceMail(...));

        throw new DeviceNotConfirmedException();
    }

    public function confirmDevice(User $user, string $deviceHash): bool
    {
        return $this->userDeviceRepository->where('user_id', $user->id)
            ->where('device_hash', $deviceHash)
            ->queryUpdate(['is_confirmed' => true]);
    }

    public function isConfirmed(User $user, string $deviceHash): bool
    {
        return $this->userDeviceRepository->where('user_id', $user->id)
            ->where('device_hash', $deviceHash)
            ->where('is_confirmed', true)
            ->queryExists();
    }

    protected function generateDeviceHash(DeviceConfirmationDTO $dto): string
    {
        return sha1($this->parseDeviceName($dto->userAgent) . '|' . $dto->ip);
    }

    protected function parseDeviceName(string $userAgent): string
    {
        return UserAgentParser::parse($userAgent);
    }
}
