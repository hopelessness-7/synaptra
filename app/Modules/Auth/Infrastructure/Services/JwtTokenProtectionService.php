<?php

namespace App\Modules\Auth\Infrastructure\Services;

use App\Contracts\CacheRepositoryInterface;
use App\Modules\Auth\Infrastructure\Repositories\Eloquent\BlacklistRepository;
use App\Modules\Auth\Infrastructure\Services\Auth\Log;
use App\Repositories\Eloquent\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

final class JwtTokenProtectionService
{
    protected int $maxAttempts = 5;
    protected int $blockMinutes = 30;
    protected string $blacklistPrefix = 'jwt_blacklist_';
    protected string $attemptsPrefix = 'jwt_failed_attempts_';

    public function __construct(
        protected UserRepository $userRepository,
        protected CacheRepositoryInterface $cache,
        protected BlacklistRepository $blacklistRepository
    ) {}

    /**
     * Полная проверка токена: валидность, fingerprint, ревокация
     */
    public function validateToken(string $token): bool
    {
        try {
            if (!$payload = JWTAuth::setToken($token)->getPayload()) {
                \Log::warning('Invalid JWT payload', ['token' => substr($token, 0, 20) . '...']);
                return false;
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            \Log::error('JWT validation failed', ['error' => $e->getMessage(), 'token' => substr($token, 0, 20) . '...']);
            return false;
        }

        // Проверка на отзыв токена
        if ($this->isTokenRevoked($token)) {
            \Log::info('Token is revoked', ['token' => substr($token, 0, 20) . '...']);
            return false;
        }

        // Превышено количество попыток?
        if ($this->hasExceededFailedAttempts($token)) {
            \Log::warning('Too many failed attempts for token', ['token' => substr($token, 0, 20) . '...']);
            $this->revokeToken($token);
            return false;
        }

        // Проверка Fingerprint (IP + User-Agent)
        if (!$this->isFingerprintValid($payload)) {
            $this->trackFailedAttempt($token);
            \Log::notice('Fingerprint mismatch', [
                'expected_ip' => $payload->get('ip_address'),
                'actual_ip' => request()->ip(),
                'expected_ua' => $payload->get('user_agent'),
                'actual_ua' => request()->userAgent()
            ]);
            return false;
        }

        // Требуется повторная авторизация
        if ($this->isReAuthRequired($token)) {
            \Log::info('Re-auth required for user', ['user_id' => $payload->get('sub')]);
            return false;
        }

        return true;
    }

    /**
     * Добавление токена в черный список (ревокация)
     */
    public function revokeToken(string $token): void
    {
        $key = $this->blacklistCacheKey($token);

        $this->blacklistRepository->add($token, now()->addDays(7));
        $this->cache->put($key, true, now()->addDays(7));

        // Очистка связанных данных
        $this->cache->forget($this->attemptsCacheKey($token));

        \Log::info('Token revoked', ['token' => substr($token, 0, 20) . '...']);
    }

    /**
     * Проверка, заблокирован ли токен
     */
    public function isTokenRevoked(string $token): bool
    {
        return $this->cache->has($this->blacklistCacheKey($token)) ||
            $this->blacklistRepository->exists($token);
    }

    /**
     * Проверка fingerprint: IP и User-Agent
     */
    public function isFingerprintValid($payload): bool
    {
        return $payload->get('ip_address') === request()->ip() &&
            $payload->get('user_agent') === request()->userAgent();
    }

    /**
     * Учет неудачной попытки доступа
     */
    public function trackFailedAttempt(string $token): void
    {
        $key = $this->attemptsCacheKey($token);
        $attempts = $this->cache->increment($key);

        $this->cache->put($key, $attempts, now()->addMinutes($this->blockMinutes));

        if ($attempts >= $this->maxAttempts) {
            \Log::alert('Max attempts reached. Revoking token.', ['token' => substr($token, 0, 20) . '...']);
            $userId = JWTAuth::setToken($token)->getPayload()->get('sub');
            $this->enforceReAuth($userId);
            $this->revokeToken($token);
        }
    }

    /**
     * Проверка, превышен ли лимит попыток
     */
    public function hasExceededFailedAttempts(string $token): bool
    {
        $key = $this->attemptsCacheKey($token);
        $attempts = $this->cache->get($key, 0);

        return $attempts >= $this->maxAttempts;
    }

    /**
     * Установка флага принудительной переавторизации
     */
    public function enforceReAuth(int $userId): void
    {
        $this->userRepository->setReAuthRequired($userId);
        \Log::info('User requires re-authentication', ['user_id' => $userId]);

        // Здесь можно вызвать событие или отправить уведомление
        // event(new ReAuthRequired($userId));
    }

    /**
     * Проверка, требуется ли повторная авторизация
     */
    public function isReAuthRequired(string $token): bool
    {
        $payload = JWTAuth::setToken($token)->getPayload();
        $userId = $payload->get('sub');

        return $this->userRepository->requiresReAuth($userId);
    }

    protected function blacklistCacheKey(string $token): string
    {
        return $this->blacklistPrefix . sha1($token);
    }

    protected function attemptsCacheKey(string $token): string
    {
        return $this->attemptsPrefix . sha1($token);
    }
}
