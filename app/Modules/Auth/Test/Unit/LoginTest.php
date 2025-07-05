<?php

namespace Modules\Auth\Test\Unit;

use App\Models\User;
use App\Modules\Auth\Application\DTO\Auth\LoginDTO;
use App\Modules\Auth\Application\UseCases\Auth\Login;
use App\Modules\Auth\Infrastructure\Exceptions\DeviceNotConfirmedException;
use App\Modules\Auth\Infrastructure\Services\DeviceConfirmationService;
use App\Modules\Auth\Infrastructure\Services\LoginHistoryService;
use App\Modules\Auth\Infrastructure\Services\LoginRateLimiterService;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Modules\Auth\Infrastructure\Exceptions\AccountBlockedException;
use Modules\Auth\Infrastructure\Exceptions\AuthenticationException;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    private function makeUser(): User
    {
        Hash::shouldReceive('check')
            ->with('testtesttest', Mockery::any())
            ->andReturnTrue();

        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 99999;
        $user->email = 'test@example.com';
        $user->password = '$2y$12$MnyBrmHwKgDjfteWSrDpTuDXKw2K4P0xcsVPeruLhT5dRKzkXski2';

        return  $user;
    }

    public function test_successful_login(): void
    {
        $user = $this->makeUser();

        $userRepository = Mockery::mock(UserRepository::class);
        $userRepository->shouldReceive('where')->with('email', $user->email)->andReturnSelf();
        $userRepository->shouldReceive('queryFirst')->andReturn($user);
        $userRepository->shouldReceive('isBlocked')->with($user->id)->andReturnFalse();
        $userRepository->shouldReceive('requiresReAuth')->with($user->id)->andReturnFalse();

        $rateLimiter = Mockery::mock(LoginRateLimiterService::class);
        $rateLimiter->shouldReceive('ensureNotBlocked')->with($user->email)->once();
        $rateLimiter->shouldReceive('clearAttempts')->with($user->email)->once();

        $deviceService = Mockery::mock(DeviceConfirmationService::class);
        $deviceService->shouldReceive('handleDevice')->once();

        $loginHistory = Mockery::mock(LoginHistoryService::class);
        $loginHistory->shouldReceive('logLogin')->once();

        $useCase = new Login($userRepository, $rateLimiter, $deviceService, $loginHistory);

        $dto = LoginDTO::fromArray([
            'email'     => $user->email,
            'password'  => 'testtesttest',
            'ip'        => '127.0.0.1',
            'userAgent' => 'PostmanRuntime/7.44.0'
        ]);

        $result = $useCase->execute($dto);

        $this->assertEquals($user, $result['user']);
        $this->assertArrayHasKey('token', $result);
    }

    public function test_invalid_email_throws_authentication_exception(): void
    {
        $userRepository = Mockery::mock(UserRepository::class);
        $userRepository->shouldReceive('where')->with('email', 'wrong@example.com')->andReturnSelf();
        $userRepository->shouldReceive('queryFirst')->andReturn(null);

        $rateLimiter = Mockery::mock(LoginRateLimiterService::class);
        $deviceService = Mockery::mock(DeviceConfirmationService::class);
        $loginHistory = Mockery::mock(LoginHistoryService::class);

        $useCase = new Login($userRepository, $rateLimiter, $deviceService, $loginHistory);

        $dto = LoginDTO::fromArray([
            'email'     => 'wrong@example.com',
            'password'  => 'testtesttest',
            'ip'        => '127.0.0.1',
            'userAgent' => 'PostmanRuntime/7.44.0'
        ]);

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage("Invalid email");

        $useCase->execute($dto);
    }

    public function test_blocked_user_throws_account_blocked_exception(): void
    {
        $user = $this->makeUser();

        $userRepository = Mockery::mock(UserRepository::class);
        $userRepository->shouldReceive('where')->with('email', $user->email)->andReturnSelf();
        $userRepository->shouldReceive('queryFirst')->andReturn($user);
        $userRepository->shouldReceive('isBlocked')->with($user->id)->andReturnTrue();

        $rateLimiter = Mockery::mock(LoginRateLimiterService::class);
        $deviceService = Mockery::mock(DeviceConfirmationService::class);
        $loginHistory = Mockery::mock(LoginHistoryService::class);

        $useCase = new Login($userRepository, $rateLimiter, $deviceService, $loginHistory);

        $dto = LoginDTO::fromArray([
            'email'     => $user->email,
            'password'  => 'testtesttest',
            'ip'        => '127.0.0.1',
            'userAgent' => 'PostmanRuntime/7.44.0'
        ]);

        $this->expectException(AccountBlockedException::class);
        $this->expectExceptionMessage('Аккаунт заблокирован. Обратитесь в поддержку.');

        $useCase->execute($dto);
    }

    public function test_invalid_password_throws_authentication_exception_and_hits_limiter(): void
    {
        $user = $this->makeUser();

        $userRepository = Mockery::mock(UserRepository::class);
        $userRepository->shouldReceive('where')->with('email', $user->email)->andReturnSelf();
        $userRepository->shouldReceive('queryFirst')->andReturn($user);
        $userRepository->shouldReceive('isBlocked')->with($user->id)->andReturnFalse();
        $userRepository->shouldReceive('requiresReAuth')->with($user->id)->andReturnFalse();

        $rateLimiter = Mockery::mock(LoginRateLimiterService::class);
        $rateLimiter->shouldReceive('ensureNotBlocked')->with($user->email)->once();
        $rateLimiter->shouldReceive('handle')->with($user->email)->once();

        $deviceService = Mockery::mock(DeviceConfirmationService::class);
        $loginHistory = Mockery::mock(LoginHistoryService::class);

        $useCase = new Login($userRepository, $rateLimiter, $deviceService, $loginHistory);

        $dto = LoginDTO::fromArray([
            'email'     => $user->email,
            'password'  => 'wrong-password',
            'ip'        => '127.0.0.1',
            'userAgent' => 'PostmanRuntime/7.44.0'
        ]);

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage("Invalid password");

        $useCase->execute($dto);
    }

    public function test_requires_reauth_sets_user_active(): void
    {
        $user = $this->makeUser();

        $userRepository = Mockery::mock(UserRepository::class);
        $userRepository->shouldReceive('where')->with('email', $user->email)->andReturnSelf();
        $userRepository->shouldReceive('queryFirst')->andReturn($user);
        $userRepository->shouldReceive('isBlocked')->with($user->id)->andReturnFalse();
        $userRepository->shouldReceive('requiresReAuth')->with($user->id)->andReturnTrue();
        $userRepository->shouldReceive('setActive')->with($user->id)->once();

        $rateLimiter = Mockery::mock(LoginRateLimiterService::class);
        $rateLimiter->shouldReceive('ensureNotBlocked')->with($user->email)->once();
        $rateLimiter->shouldReceive('clearAttempts')->with($user->email)->once();

        $deviceService = Mockery::mock(DeviceConfirmationService::class);
        $deviceService->shouldReceive('handleDevice')->once();

        $loginHistory = Mockery::mock(LoginHistoryService::class);
        $loginHistory->shouldReceive('logLogin')->once();

        $useCase = new Login($userRepository, $rateLimiter, $deviceService, $loginHistory);

        $dto = LoginDTO::fromArray([
            'email'     => $user->email,
            'password'  => 'testtesttest',
            'ip'        => '127.0.0.1',
            'userAgent' => 'PostmanRuntime/7.44.0'
        ]);

        $result = $useCase->execute($dto);

        $this->assertEquals($user, $result['user']);
    }
}
