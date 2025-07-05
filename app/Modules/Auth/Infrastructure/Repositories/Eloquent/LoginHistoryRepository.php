<?php

namespace App\Modules\Auth\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Auth\Infrastructure\Models\LoginHistory;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;

class LoginHistoryRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;
    public function __construct(LoginHistory $model)
    {
        parent::__construct($model);
    }
}
