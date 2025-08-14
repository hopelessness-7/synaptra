<?php

namespace App\Modules\Project\Application\UseCases\Project;

use App\DTO\BaseDTO;
use App\Modules\Project\Domain\Enums\GradeEnum;
use App\Modules\Project\Domain\Enums\SpecializationEnum;
use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectMemberRepository;
use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Traits\Crud\HandlesCreate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Create
{
    public function __construct(
        private readonly ProjectRepository $repository,
        private readonly ProjectMemberRepository $memberRepository,
    ){}

    public function create(BaseDTO $dto): Model
    {
        $user = auth()->user();
        $projectMember = $this->memberRepository->where('user_id', $user->id)->queryFirst();

        return DB::transaction(function () use ($dto, $user, $projectMember) {
            $project = $this->repository->createFromDTO($dto);

            $this->memberRepository->create([
                'project_id'     => $project->id,
                'user_id'        => $user->id,
                'grade'          => $projectMember?->grade ?? GradeEnum::Intern,
                'specialization' => $projectMember?->specialization ?? SpecializationEnum::Frontend,
            ]);

            return $project;
        });
    }
}
