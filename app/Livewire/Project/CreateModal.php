<?php

namespace App\Livewire\Project;

use App\Modules\Project\Application\DTO\ProjectDTO;
use App\Modules\Project\Application\DTO\ProjectMemberDTO;
use App\Modules\Project\Application\UseCases\Project\Create as ProjectCreate;
use App\Modules\Project\Application\UseCases\ProjectMember\Create as MemberCreate;
use App\Modules\Project\Domain\Enums\GradeEnum;
use App\Modules\Project\Domain\Enums\SpecializationEnum;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Modules\Project\Http\Requests\Project\CreateRequest;

class CreateModal extends Component
{
    public string $name;
    public string $slug;
    public string $description;
    public string $git_repo_url;
    public ?string $type;


    public function create(): Redirector
    {
        // изменить полностью логику, сделать этапы настройки перед началом использования с созданием собственных ролей.

        $data = CreateRequest::validateData([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'git_repo_url' => $this->git_repo_url,
        ]);

        $dto = (ProjectDTO::class)::fromArray($data);

        $project = app(ProjectCreate::class)->create($dto);


        $memberDto = (ProjectMemberDTO::class)::fromArray([
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'grade' => GradeEnum::Lead,
            'specialization' => SpecializationEnum::PM,
        ]);

        app(MemberCreate::class)->create($memberDto);

        session()->flash('success', 'Project created successfully!');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.project.create-modal');
    }
}
