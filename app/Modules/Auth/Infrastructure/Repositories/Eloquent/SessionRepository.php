<?php

namespace App\Modules\Auth\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Auth\Infrastructure\Models\Session;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;

class SessionRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;

    public function __construct(Session $model)
    {
        parent::__construct($model);
    }

    public function touch(string|int $sessionId): void
    {
        $this->model->where('id', $sessionId)->update(['last_activity' => time()]);
    }

    public function isFingerprintValid(string|int $sessionId): bool
    {
        $session = $this->model->where('id', $sessionId)->first();

        if (!$session) {
            return false;
        }

        return $session->ip_address === request()->ip() &&
            $session->user_agent === request()->userAgent();
    }

    public function delete($sessionId): void
    {
        $this->model->where('id', $sessionId)->delete();
    }
}
