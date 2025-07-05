<?php

namespace Modules\Project\Http\Requests\MemberSkill;

use App\Http\Request\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'member_id'  => 'nullable|integer|exists:members,id',
            'skill'      => 'nullable|string|max:255|min:3',
            'level'      => 'nullable|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
