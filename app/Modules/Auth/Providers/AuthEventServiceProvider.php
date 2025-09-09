<?php

namespace Modules\Auth\Providers;

use App\Modules\Auth\Infrastructure\Listeners\CreateDefaultColumnsListener;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Infrastructure\Events\BoardCreatedEvent;
use Modules\Auth\Infrastructure\Events\ProjectCreatedEvent;
use Modules\Auth\Infrastructure\Events\UserRegisteredEvent;
use Modules\Auth\Infrastructure\Listeners\CreateDefaultBoardListener;
use Modules\Auth\Infrastructure\Listeners\CreateDefaultProjectListener;
use Modules\Auth\Infrastructure\Listeners\RegisterUserDeviceListener;

class AuthEventServiceProvider extends ServiceProvider
{
    protected array $listen = [
        UserRegisteredEvent::class => [
          RegisterUserDeviceListener::class,
          CreateDefaultProjectListener::class,
        ],

        BoardCreatedEvent::class => [
            CreateDefaultColumnsListener::class,
        ],

        ProjectCreatedEvent::class => [
            CreateDefaultBoardListener::class,
        ]
    ];
}
