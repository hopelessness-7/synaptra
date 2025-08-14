<?php

namespace Modules\Auth\Http\Requests;

use App\Http\Request\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'excel_file' => 'required|file|mimes:xls,xlsx',
            'project_id' => 'required|integer|exists:projects,id',
        ];
    }
}
