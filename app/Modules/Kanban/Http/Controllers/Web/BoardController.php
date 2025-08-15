<?php

namespace Modules\Kanban\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Kanban\Application\DTO\BoardDTO;
use App\Modules\Kanban\Application\UseCases\Board\Delete;
use App\Modules\Kanban\Application\UseCases\Board\GetView;
use App\Modules\Kanban\Application\UseCases\Board\Show;
use App\Modules\Kanban\Application\UseCases\Board\Update;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Kanban\Http\Requests\Board\UpdateRequest;
use Modules\Kanban\Infrastructure\Exceptions\BoardNotFoundException;

class BoardController extends Controller
{
    /**
     * @throws BoardNotFoundException
     */
    public function show(Show $show, int $id, $columnId = null, $taskId = null): View
    {
        $board = app(GetView::class)->execute($show->show($id));
        return view('kanban.board.show', compact('board', 'columnId', 'taskId'));
    }

    public function edit(): View
    {
        return view('kanban.board.edit');
    }

    public function update(UpdateRequest $request, Update $update, int $id): RedirectResponse
    {
        $dto = BoardDTO::fromRequest($request);
        $update->update($dto);

        return redirect()->back()->with('success', 'Board updated successfully');
    }

    public function destroy(Delete $delete, int $id): RedirectResponse
    {
        $delete->delete($id);

        return redirect()->route('dashboard')->with('success', 'Board deleted successfully');
    }
}
