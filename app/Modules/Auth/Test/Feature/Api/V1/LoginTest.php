<?php

namespace Modules\Auth\Test\Feature\Api\V1;

use App\Enums\UserStatusEnum;
use App\Models\User;
use App\Modules\Auth\Infrastructure\Utils\UserAgentParser;
use Faker\Provider\UserAgent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_login(): void
    {
        $user = User::factory()->create([
            'email'    => 'feature@test.com',
            'password' => bcrypt('password'),
            'status'   =>  UserStatusEnum::Active,
        ]);

        $header = [
            'User-Agent'  => UserAgent::userAgent(),
            'REMOTE_ADDR' => '123.123.123.123'
        ];

        $user->devices()->create([
           'device_hash'  => sha1(UserAgentParser::parse($header['User-Agent']) . '|' . $header['REMOTE_ADDR']),
           'is_confirmed' => true,
           'device_name'  => UserAgentParser::parse($header['User-Agent']),
           'last_used_at' => now(),
        ]);

        $payload = [
            'email'    => $user->email,
            'password' => 'password',
        ];

        $response = $this->json('POST', '/api/v1/login', $payload, $header);

        $response->assertOk();

        $response->assertJsonFragment([
            'email' => $user->email,
            'code'  => 'SUCCESSFUL'
        ]);

        $response->assertCookie('token');
    }

    public function test_login_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'email'    => 'feature@test.com',
            'password' => bcrypt('password123'),
        ]);

        $payload = [
            'email'    => $user->email,
            'password' => 'password',
        ];

        $response = $this->json('POST', '/api/v1/login', $payload);

        $response->assertUnauthorized();

        $response->assertJsonFragment([
            'code' => 'AUTHENTICATION_FAILED'
        ]);
    }

    public function test_login_blocked_user(): void
    {
        $user = User::factory()->create([
            'email'    => 'feature@test.com',
            'password' => bcrypt('password'),
            'status'   =>  UserStatusEnum::Blocked,
        ]);

        $payload = [
            'email'    => $user->email,
            'password' => 'password',
        ];
        $response = $this->json('POST', '/api/v1/login', $payload);

        $response->assertForbidden();

        $response->assertJsonFragment([
            'code' => 'ACCOUNT_BLOCKED'
        ]);
    }

    public function test_login_with_nonexistent_email(): void
    {
        $response = $this->postJson('/api/v1/login', [
            'email'    => 'nonexistent@example.com',
            'password' => 'somepassword',
        ]);

        $response->assertForbidden();

        $response->assertJsonFragment([
            'code' => 'AUTHENTICATION_FAILED'
        ]);
    }

    public function test_login_from_new_device_requires_confirmation(): void
    {
        $user = User::factory()->create([
            'status'   => 'active',
            'password' => bcrypt('password'),
        ]);

        $headers = [
            'User-Agent'  => UserAgent::userAgent(),
            'REMOTE_ADDR' => '123.123.123.123'
        ];

        $payload = [
            'email'    => $user->email,
            'password' => 'password',
        ];

        $response = $this->json('POST', '/api/v1/login', $payload, $headers);

        $response->assertForbidden();

        $response->assertJsonFragment([
            'code' => 'DEVICE_NOT_CONFIRMED'
        ]);
    }

    public function test_too_many_failed_attempts_blocks_user_temporarily_or_permanently(): void
    {
        $user = User::factory()->create([
            'status'   => 'active',
            'password' => bcrypt('correctpassword'),
        ]);

        $header = [
            'User-Agent'  => UserAgent::userAgent(),
            'REMOTE_ADDR' => '123.123.123.123'
        ];

        $user->devices()->create([
            'device_hash'  => sha1(UserAgentParser::parse($header['User-Agent']) . '|' . $header['REMOTE_ADDR']),
            'is_confirmed' => true,
            'device_name'  => UserAgentParser::parse($header['User-Agent']),
            'last_used_at' => now(),
        ]);

        $email = $user->email;

        for ($i = 0; $i < 4; $i++) {
            $response = $this->postJson('/api/v1/login', [
                'email'    => $email,
                'password' => 'wrongpassword',
            ], $header);

            if ($i === 3) {
                $response->assertForbidden();
                $response->assertJsonFragment([
                    'code' => 'ACCOUNT_BLOCKED'
                ]);
                continue;
            }

            $response->assertUnauthorized();

            $response->assertJsonFragment([
                'code' => 'AUTHENTICATION_FAILED'
            ]);
        }

        $response = $this->postJson('/api/v1/login', [
            'email'    => $email,
            'password' => 'correctpassword',
        ], $header);

        $response->assertForbidden();

        $response->assertJsonFragment([
            'code' => 'ACCOUNT_BLOCKED'
        ]);
    }
}
