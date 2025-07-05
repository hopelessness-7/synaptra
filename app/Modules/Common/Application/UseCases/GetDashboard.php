<?php

namespace App\Modules\Common\Application\UseCases;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\BoardRepository;
use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskRepository;
use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectRepository;
use Illuminate\Support\Facades\Cache;

class GetDashboard
{
    public function __construct(
        private readonly BoardRepository $boardRepository,
        private readonly TaskRepository $taskRepository,
        private readonly ProjectRepository $projectRepository
    ){}

    public function execute(): array
    {
        $userId = auth()->user()->id;

        $cacheKey = "dashboard_data_user_{$userId}";

//        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($userId) {
//
//        });

        $boards = $this->boardRepository->getActiveOrDefaultBoards($userId);
        $urgentTasks = $this->taskRepository->getUrgentTasks($userId);
        $planningTasks = $this->taskRepository->getWeeklyTasks($userId);

        return [
            'boards' => $boards,
            'urgentTasks' => $urgentTasks,
            'planningTasks' => $planningTasks,
            'stats' => [
                'count' => [
                    'completed_tasks' => $this->taskRepository->countCompletedTasksForUser($userId),
                    'active_boards' => $this->boardRepository->countActiveBoardsForUser($userId),
                    'projects' => $this->projectRepository->countProjectsForUser($userId),
                ]
            ]
        ];
    }
}
