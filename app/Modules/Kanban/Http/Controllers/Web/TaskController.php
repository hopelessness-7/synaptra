<?php

namespace Modules\Kanban\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function show(int $boardId, int $columnId, int $taskId): RedirectResponse
    {
        return redirect()->route('kanban.boards.show', [$boardId, $columnId, $taskId]);
    }
}
