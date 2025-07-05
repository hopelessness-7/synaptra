<?php

namespace App\Modules\Auth\Application\Commands;

use App\Modules\Auth\Infrastructure\Repositories\Eloquent\BlacklistRepository;
use Illuminate\Console\Command;

class CleanBlacklist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jwt:clean-blacklist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаляет просроченные токены из черного списка';

    public function __construct(protected BlacklistRepository $blacklistRepository)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $deletedCount = $this->blacklistRepository->removeExpired();

        $this->info("Удалено просроченных токенов: {$deletedCount}");
    }
}
