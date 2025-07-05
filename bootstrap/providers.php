<?php

return [
    App\Modules\Auth\Providers\AuthServiceProvider::class,
    App\Modules\Common\Providers\SearchServiceProvider::class,
    App\Providers\AppServiceProvider::class,
    App\Modules\Auth\Providers\ExceptionServiceProvider::class,
    App\Providers\ModuleCommandServiceProvider::class,
    Modules\Project\Providers\ProjectServiceProvider::class,
    Modules\Kanban\Providers\KanbanServiceProvider::class,
    Modules\Common\Providers\CommonServiceProvider::class,
];
