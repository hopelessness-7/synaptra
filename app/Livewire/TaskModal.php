<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\Kanban\Infrastructure\Models\Task;

class TaskModal extends Component
{
    public $show = false;
    public $task;

    protected $listeners = [
        'openTaskModal' => 'open',
        'closeTaskModal' => 'close'
    ];

    public function open($taskId): void
    {
        $this->task = Task::findOrFail($taskId);
        $this->show = true;
    }

    public function close(): void
    {
        $this->show = false;
        $this->task = null;
    }

    public function render()
    {
        return view('livewire.task-modal');
    }
}
