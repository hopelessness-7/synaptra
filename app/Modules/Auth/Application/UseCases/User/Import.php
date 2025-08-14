<?php

namespace App\Modules\Auth\Application\UseCases\User;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Modules\Auth\Application\Jobs\ImportUsersJob;

class Import
{
    public function execute(UploadedFile $file, int $projectId): void
    {
        $path = $file->store('tmp/imports');
        ImportUsersJob::dispatch($path, $projectId);
    }
}
