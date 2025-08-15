<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\Kanban\Infrastructure\Models\Task;

class TaskSidebar extends Component
{
    public $show = false;
    public $task;
    public $boardId;
    public $taskId;
    public $columnId;

    protected $listeners = ['openTaskPanel' => 'open'];

    public function mount(): void
    {
        $route = request()->route();
        $params = $route->parameters();

        $taskId = $params['taskId'] ?? null;
        $this->columnId = $params['columnId'] ?? null;
        $this->boardId = $params['boardId'] ?? null;

        if ($taskId) {
            $this->open($taskId);
        }
    }

    public function open($taskId)
    {
        $this->dispatch('closeTaskModal')->to('task-modal');
        $this->task = Task::findOrFail($taskId);
        $this->boardId = $this->task->column->board_id;
        $this->taskId = $this->task->id;
        $this->columnId = $this->task->column_id;
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
        $this->task = null;
    }

    public function render()
    {
        return view('livewire.task-sidebar');
    }
}
