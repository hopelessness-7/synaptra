<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\Auth\Infrastructure\Models\UserDevice;
use App\Modules\Kanban\Domain\Enums\RelationTypeEnum;
use App\Modules\Project\Infrastructure\Models\Project;
use App\Modules\Project\Infrastructure\Models\ProjectMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Kanban\Infrastructure\Models\Board;
use Modules\Kanban\Infrastructure\Models\Column;
use Modules\Kanban\Infrastructure\Models\Task;
use Random\RandomException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws RandomException
     */
    public function run(): void
    {
        // 1. Users
        User::factory()->count(2500)->create();

        User::factory()->create([
           'email' => 'admin@admin.com',
           'password' => 'password',
        ]);

        $users = User::all();

        // 2. Projects
        Project::factory()->count(250)->create();
        $projects = Project::all();

        // 4. User devices
        foreach ($users as $user) {
            if (random_int(0, 1)) {
                UserDevice::factory()->count(random_int(1, 3))->create([
                    'user_id' => $user->id,
                ]);
            }
        }

        // 5. Boards + Columns
        foreach ($projects as $project) {
            $boards = Board::factory()->count(4)->create([
                'project_id' => $project->id,
            ]);

            foreach ($boards as $board) {
                $columnsData = [
                    ['title' => 'Backlog', 'position' => 1],
                    ['title' => 'In the process', 'position' => 2],
                    ['title' => 'Completed', 'position' => 3],
                ];

                foreach ($columnsData as $columnData) {
                    Column::create([
                        ...$columnData,
                        'board_id' => $board->id,
                    ]);
                }
            }
        }

        $columns = Column::all();

        // 6. Project Members
        foreach ($projects as $project) {
            $members = $users->random(10); // Например по 10 человек на проект

            foreach ($members as $user) {
                ProjectMember::factory()->create([
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        // 7. Tasks
        foreach ($columns as $column) {
            $projectMembers = $column->board->project->members()->pluck('user_id');

            for ($i = 1; $i <= 5; $i++) {
                Task::factory()->create([
                    'column_id' => $column->id,
                    'assignee_id' => $projectMembers->random(),
                    'creator_id' => $projectMembers->random(),
                    'position' => $i,
                ]);
            }
        }

        $tasks = Task::all();

        // 8. Добавляем watchers к случайным задачам
        $randomTasksForWatchers = $tasks->random(300);

        foreach ($randomTasksForWatchers as $task) {
            $projectMembers = $task->column->board->project->members()->pluck('user_id');

            // Случайные участники проекта (1-5 человек)
            $watcherUsers = $projectMembers->random(random_int(1, min(5, $projectMembers->count())));

            $task->watchers()->attach($watcherUsers);
        }

        // 9. Добавляем coAssignees к другим случайным задачам
        $randomTasksForCoAssignees = $tasks->random(300);

        foreach ($randomTasksForCoAssignees as $task) {
            $projectMembers = $task->column->board->project->members()->pluck('user_id');

            // Случайные участники проекта (1-3 человек)
            $coAssignees = $projectMembers->random(random_int(1, min(3, $projectMembers->count())));

            $task->coAssignees()->attach($coAssignees);
        }

        // 10. Добавляем task relations к другим случайным задачам
        $randomTasksForRelations = $tasks->random(5000);
        foreach ($randomTasksForRelations as $task) {
            $relatedTasks = $tasks->where('id', '!=', $task->id)->random(1);
            foreach ($relatedTasks as $related) {
                DB::table('task_relations')->insert([
                    'task_id' => $task->id,
                    'related_task_id' => $related->id,
                    'relation_type' => Arr::random(RelationTypeEnum::toArray()),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
