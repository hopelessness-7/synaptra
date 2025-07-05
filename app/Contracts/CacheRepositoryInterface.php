<?php

namespace App\Contracts;

interface CacheRepositoryInterface
{
    public function get(string $key, mixed $default = null): mixed;
    public function put(string $key, mixed $value, $ttl = null): void;
    public function increment(string $key, int $amount = 1): int;
    public function forget(string $key): void;
    public function has(string $key): bool;
}
