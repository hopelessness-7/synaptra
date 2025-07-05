<?php

namespace Modules\Kanban\Http\Requests\Task;

use App\Http\Request\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class InviteRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
        ];
    }
}
