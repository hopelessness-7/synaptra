<?php

use Illuminate\Support\Facades\Route;
use Modules\Project\Http\Controllers\Api\V1\MemberMetricController;
use Modules\Project\Http\Controllers\Api\V1\MemberSkillController;
use Modules\Project\Http\Controllers\Api\V1\ProjectController;
use Modules\Project\Http\Controllers\Api\V1\ProjectMemberController;

Route::prefix('api/v1')->middleware('auth.api')->group(function () {

    // Общее определение CRUD маршрутов
    $resources = [
        'projects' => ProjectController::class,
        'projects/members' => ProjectMemberController::class,
        'projects/members/skills' => MemberSkillController::class,
        'projects/members/metrics' => MemberMetricController::class,
    ];

    foreach ($resources as $prefix => $controller) {
        Route::prefix($prefix)->controller($controller)->group(function () {
            Route::get('/', 'index');
            Route::get('/{id}', 'show')->whereNumber('id');
            Route::post('/', 'store');
            Route::patch('/{id}', 'update')->whereNumber('id');
            Route::delete('/{id}', 'destroy')->whereNumber('id');
        });
    }
});





