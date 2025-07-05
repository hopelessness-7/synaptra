<?php

namespace App\Modules\Project\Application\UseCases\MemberMetric;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\MemberMetricRepository;
use App\Traits\Crud\HandlesUpdate;

class Update
{
    use HandlesUpdate;

    public function __construct(
        private readonly MemberMetricRepository $repository
    ){}
}
