<?php

namespace Modules\Project\Http\Requests\MemberSkill;

use App\Http\Request\BaseFormRequest;

class CreateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'member_id'  => 'required|integer|exists:members,id',
            'skill'      => 'required|string|max:255|min:3',
            'level'      => 'nullable|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
