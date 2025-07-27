<?php

namespace App\Modules\AccessControl\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;
use Modules\AccessControl\Infrastructure\Models\Permission;

class PermissionRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;

    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }
}
