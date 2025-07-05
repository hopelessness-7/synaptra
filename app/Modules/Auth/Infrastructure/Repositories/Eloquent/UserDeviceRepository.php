<?php

namespace App\Modules\Auth\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Auth\Infrastructure\Models\UserDevice;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;

class UserDeviceRepository extends BaseRepository implements DTORepositoryInterface
{
     use HandlesDTO;

     public function __construct(UserDevice $model)
     {
         parent::__construct($model);
     }
}
