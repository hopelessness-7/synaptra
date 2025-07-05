<?php

namespace App\Modules\Project\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Project\Infrastructure\Models\MemberMetric;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;

class MemberMetricRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;
   public function __construct(MemberMetric $model)
   {
       parent::__construct($model);
   }
}
