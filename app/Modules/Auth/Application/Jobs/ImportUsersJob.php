<?php

namespace Modules\Auth\Application\Jobs;

use App\Models\User;
use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\RoleRepository;
use App\Modules\Project\Domain\Enums\GradeEnum;
use App\Modules\Project\Domain\Enums\SpecializationEnum;
use App\Modules\Project\Infrastructure\Models\Project;
use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectMemberRepository;
use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $path;
    private int $projectId;

    public function __construct(string $path, int $projectId)
    {
        $this->path = $path;
        $this->projectId = $projectId;
    }

    public function handle(): void
    {
        $fullPath = Storage::path($this->path);

        $spreadsheet = IOFactory::load($fullPath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        array_shift($rows);

        $project = app(ProjectRepository::class)->find($this->projectId);
        $role = app(RoleRepository::class)->where('name', 'employee')->queryFirst();

        foreach (array_chunk($rows, 500) as $chunk) {
            foreach ($chunk as $row) {
                [$name, $email, $password] = $row;

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $user = app(UserRepository::class)->create([
                        'name'     => $name,
                        'email'    => $email,
                        'password' => bcrypt($password),
                        'role_id'  => $role->id,
                    ]);

                    app(ProjectMemberRepository::class)->create([
                        'project_id' => $project->id,
                        'user_id' => $user->id,
                        'grade' => GradeEnum::Intern,
                        'specialization' => SpecializationEnum::Frontend
                    ]);
                }
            }
        }

        Storage::delete($this->path);
    }
}
