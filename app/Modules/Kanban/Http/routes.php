<?php

use Illuminate\Support\Facades\Route;
use Modules\Kanban\Http\Controllers\Api\V1\BoardController;
use Modules\Kanban\Http\Controllers\Api\V1\BoardViewController;
use Modules\Kanban\Http\Controllers\Api\V1\ColumnController;
use Modules\Kanban\Http\Controllers\Api\V1\TaskController;
use Modules\Kanban\Http\Controllers\Api\V1\TaskInviteController;
use Modules\Kanban\Http\Controllers\Api\V1\TaskRelationsController;





Route::prefix('api/v1')->middleware('auth.api')->group(function () {
    Route::post('/kanban/tasks/{task}/{action}/{type}', TaskRelationsController::class);
    Route::post('/kanban/boards/view/{board}', BoardViewController::class);

    Route::prefix('/kanban/tasks/{task}/invite')->controller(TaskInviteController::class)->group(function () {
        Route::get('/add/watchers', 'addWatchers');
        Route::get('/add/co-assignees', 'addCoAssignees');
        Route::post('/remove/watchers', 'removeWatchers');
        Route::post('/remove/co-assignees', 'removeCoAssignees');
    });

    $resources = [
        'kanban/boards' => ['controller' => BoardController::class, 'param' => 'board'],
        'kanban/columns' => ['controller' => ColumnController::class, 'param' => 'column'],
        'kanban/tasks' => ['controller' => TaskController::class, 'param' => 'task'],
    ];

    foreach ($resources as $prefix => ['controller' => $controller, 'param' => $param]) {
        Route::prefix($prefix)->controller($controller)->group(function () use ($param) {
            Route::get('/', 'index');
            Route::get('/{' . $param . '}', 'show');
            Route::post('/', 'store');
            Route::patch('/{' . $param . '}', 'update');
            Route::delete('/{' . $param . '}', 'destroy');
        });
    }
});


