<?php

namespace App\DTO;

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
}
