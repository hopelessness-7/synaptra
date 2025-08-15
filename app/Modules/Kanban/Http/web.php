<?php

use Illuminate\Support\Facades\Route;
use Modules\Kanban\Http\Controllers\Web\BoardController;
use Modules\Kanban\Http\Controllers\Web\TaskController;

Route::middleware(['web', 'auth.web'])->group(function () {
    Route::prefix('kanban')->name('kanban.')->group(function () {
        Route::get('/boards/{id}', [BoardController::class, 'show'])->name('boards.show');
        Route::get('/boards/{boardId}/columns/{columnId}/tasks/{taskId}', [BoardController::class, 'show'])->name('tasks.show');
    });
});
