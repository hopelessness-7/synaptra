<?php

namespace App\DTO;

use Illuminate\Http\Request;

class BaseDTO
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function toArray(): array
    {

        return array_map(static function ($value) {
            return $value instanceof \BackedEnum ? $value->value : $value;
        }, get_object_vars($this));
    }

    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    public static function fromRequest(Request $request): static
    {
        return new static($request->only(array_keys(get_class_vars(static::class))));
    }
}
