<?php

namespace App\Modules\Project\Application\UseCases\ProjectMember;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectMemberRepository;
use App\Traits\Crud\HandlesGet;

class Get
{
    use HandlesGet;

    public function __construct(
        private readonly ProjectMemberRepository $repository
    ){}
}
