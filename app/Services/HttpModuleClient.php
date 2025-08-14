<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class HttpModuleClient
{
    protected function withBaseConfig(string $module): PendingRequest
    {
        $url = config("modules.$module");

        return Http::withHeader('Accept', 'application/json')->withCookies([
            'token' => request()->cookie('token'),
        ], 'localhost')
            ->baseUrl($url);
    }

    public function to(string $module): PendingRequest
    {
        return $this->withBaseConfig($module);
    }

    public function __call(string $method, array $arguments): PendingRequest
    {
        if (config("modules.$method")) {
            return $this->to($method);
        }

        throw new \BadMethodCallException("Method $method does not exist.");
    }
}
