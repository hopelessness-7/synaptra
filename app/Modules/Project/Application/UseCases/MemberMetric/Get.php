<?php

namespace App\Modules\Project\Application\UseCases\MemberMetric;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\MemberMetricRepository;
use App\Traits\Crud\HandlesGet;

class Get
{
    use HandlesGet;

    public function __construct(
        private readonly MemberMetricRepository $repository
    ){}
}
