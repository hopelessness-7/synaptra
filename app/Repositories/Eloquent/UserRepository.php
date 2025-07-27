<?php

namespace App\Repositories\Eloquent;

use App\Enums\UserStatusEnum;
use App\Models\User;
use App\Traits\HandlesDTO;
use Modules\AccessControl\Infrastructure\Models\Role;

class UserRepository extends BaseRepository
{
    use HandlesDTO;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    public function setStatus(User $user, UserStatusEnum $status): User
    {
        $user->status = $status;
        $user->save();

        return $user;
    }

    public function findAndSetStatus(int|string $idOrEmail, UserStatusEnum $status): ?User
    {
        $user = is_int($idOrEmail)
            ? $this->find($idOrEmail)
            : $this->getUserByEmail($idOrEmail);

        if (!$user) {
            return null;
        }

        return $this->setStatus($user, $status);
    }

    public function requiresReAuth(int $userId): bool
    {
        $user = $this->find($userId);
        return $user?->status === UserStatusEnum::RequiresReauth;
    }

    public function isBlocked(int $userId): bool
    {
        $user = $this->find($userId);
        return $user?->status === UserStatusEnum::Blocked;
    }

    public function isActive(int $userId): bool
    {
        $user = $this->find($userId);
        return $user?->status === UserStatusEnum::Active;
    }

    public function setBlocked(int|string $idOrEmail): ?User
    {
        return $this->findAndSetStatus($idOrEmail, UserStatusEnum::Blocked);
    }

    public function setActive(int|string $idOrEmail): ?User
    {
        return $this->findAndSetStatus($idOrEmail, UserStatusEnum::Active);
    }

    public function setReAuthRequired(int|string $idOrEmail): ?User
    {
        return $this->findAndSetStatus($idOrEmail, UserStatusEnum::RequiresReauth);
    }

    public function attachRoleToUser(Role $role, int $userId): User
    {
        $user = $this->find($userId)?->update(['role_id' => $role->id]);

        return $user;
    }
}
