<?php

namespace App\Http\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(response()->json([
                'code'    => 'VALIDATION_ERROR',
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422));
        }

        parent::failedValidation($validator);
    }

    /**
     * Позволяет валидировать массив данных вне HTTP-контекста (например, в Livewire).
     */
    public static function validateData(array $data): array
    {
        $instance = new static();

        return validator($data, $instance->rules(), $instance->messages(), $instance->attributes())->validate();
    }
}

