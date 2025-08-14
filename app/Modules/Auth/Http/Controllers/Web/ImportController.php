<?php

namespace App\Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Application\UseCases\User\Import;
use Illuminate\Http\RedirectResponse;
use Modules\Auth\Http\Requests\ImportRequest;

class ImportController extends Controller
{

    public function import(Import $import, ImportRequest $request): RedirectResponse
    {
        $import->execute($request->file('excel_file'), $request->get('project_id'));
        return redirect()->back()->with('success', 'The import of employees has begun. It is running in the background, so you can continue working.');

    }
}
