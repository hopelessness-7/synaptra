<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Factories\Factory;

trait HasModuleFactory
{
    protected static function newFactory(): Factory
    {
        $factoryClass = str_replace(
                'Infrastructure\Models',
                'Infrastructure\Database\Factories',
                static::class
            ) . 'Factory';

        if (!class_exists($factoryClass)) {
            throw new \RuntimeException("Factory class [$factoryClass] not found.");
        }

        return $factoryClass::new();
    }
}
