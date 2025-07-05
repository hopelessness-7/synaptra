<?php

namespace App\Modules\Project\Application\UseCases\MemberMetric;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\MemberMetricRepository;
use App\Traits\Crud\HandlesCreate;

class Create
{
    use HandlesCreate;

    public function __construct(
        private readonly MemberMetricRepository $repository
    ){}
}
