<?php

namespace App\Repositories\Cache;

use App\Contracts\CacheRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class CacheRepository implements CacheRepositoryInterface
{

    public function get(string $key, mixed $default = null): mixed
    {
        return Cache::get($key, $default);
    }

    public function put(string $key, mixed $value, $ttl = null): void
    {
        Cache::put($key, $value, $ttl);
    }

    public function increment(string $key, int $amount = 1): int
    {
        return Cache::increment($key, $amount);
    }

    public function forget(string $key): void
    {
        Cache::forget($key);
    }

    public function has(string $key): bool
    {
        return Cache::has($key);
    }
}
