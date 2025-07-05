<?php

namespace App\Modules\Auth\Infrastructure\Database\Factories;

use App\Modules\Auth\Infrastructure\Models\UserDevice;
use App\Modules\Auth\Infrastructure\Utils\UserAgentParser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserDeviceFactory extends Factory
{
    protected $model = UserDevice::class;

    public function definition(): array
    {
        $userAgent = $this->faker->userAgent();
        $userUpRandom = $this->faker->ipv6();
        $deviceName = UserAgentParser::parse($userAgent);

        return [
            'device_hash' => sha1($deviceName . '|' . $userUpRandom),
            'device_name' => $deviceName,
            'is_confirmed' => $this->faker->boolean(),
            'last_used_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
