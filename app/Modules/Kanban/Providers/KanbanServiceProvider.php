<?php

namespace Modules\Kanban\Providers;

use App\Modules\Kanban\Infrastructure\Events\BoardUpdatedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Infrastructure\Listeners\RefreshBoardCacheListener;
use Modules\Kanban\Infrastructure\Models\Board;
use Modules\Kanban\Infrastructure\Models\Column;
use Modules\Kanban\Infrastructure\Models\Task;
use Modules\Kanban\Infrastructure\Observers\BoardObserver;
use Modules\Kanban\Infrastructure\Observers\ColumnObserver;
use Modules\Kanban\Infrastructure\Observers\TaskObserver;

class KanbanServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Http/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Infrastructure/Database/Migrations');

        Task::observe(TaskObserver::class);
        Board::observe(BoardObserver::class);
        Column::observe(ColumnObserver::class);

        Event::listen(
            BoardUpdatedEvent::class,
            RefreshBoardCacheListener::class
        );
    }
}
