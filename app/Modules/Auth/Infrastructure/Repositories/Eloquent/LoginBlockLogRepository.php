<?php

namespace App\Modules\Auth\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Auth\Infrastructure\Models\LoginBlockLog;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;

class LoginBlockLogRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;
    public function __construct(LoginBlockLog $model)
    {
        parent::__construct($model);
    }
}
