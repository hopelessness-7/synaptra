<?php

namespace Modules\Auth\Http\Requests;

use App\Http\Request\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
