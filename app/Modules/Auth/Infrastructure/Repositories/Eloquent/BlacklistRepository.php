<?php

namespace App\Modules\Auth\Infrastructure\Repositories\Eloquent;

use App\Modules\Auth\Infrastructure\Models\JwtBlacklist;
use App\Repositories\Eloquent\BaseRepository;

class BlacklistRepository extends BaseRepository
{
    public function __construct(JwtBlacklist $model)
    {
        parent::__construct($model);
    }

    public function add(string $token, string $expiresAt): void
    {
        $hash = sha1($token);

        $jwtToken = $this->model->where('token_hash', $hash)->first();

        if (!$jwtToken) {
            $this->create([
                'token_hash' => $hash,
                'expires_at' => $expiresAt,
            ]);
            return;
        }

        $jwtToken->expires_at = $expiresAt;
        $jwtToken->save();
    }

    public function exists(string $token): bool
    {
        return $this->model->where('token_hash', sha1($token))
            ->where('expires_at', '>', now())
            ->exists();
    }

    public function removeExpired(): int
    {
        return $this->model->where('expires_at', '<=', now())->delete();
    }
}
