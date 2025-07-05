<?php

namespace App\Modules\Auth\Domain\Contracts;

use App\Models\User;
use App\Modules\Auth\Application\DTO\Auth\DeviceConfirmationDTO;

interface DeviceConfirmationServiceInterface
{
    public function handleDevice(User $user, DeviceConfirmationDTO $deviceDTO): void;

    public function confirmDevice(User $user, string $deviceHash): bool;

    public function isConfirmed(User $user, string $deviceHash): bool;
}
