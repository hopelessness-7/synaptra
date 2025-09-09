<?php

namespace App\Modules\Auth\Infrastructure\Listeners;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\ColumnRepository;
use Modules\Auth\Infrastructure\Events\BoardCreatedEvent;

class CreateDefaultColumnsListener
{
    public function __construct(
        private readonly ColumnRepository $columnRepository,
    ){}

    public function handle(BoardCreatedEvent $event): void
    {
        $this->columnRepository->createDefaultColumns($event->boardId);
    }
}
