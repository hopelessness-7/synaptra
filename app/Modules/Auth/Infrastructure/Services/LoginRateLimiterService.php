<?php

namespace App\Modules\Auth\Infrastructure\Services;

use App\Contracts\CacheRepositoryInterface;
use App\Modules\Auth\Application\DTO\Auth\LoginBlockLogDTO;
use App\Modules\Auth\Infrastructure\Repositories\Eloquent\LoginBlockLogRepository;
use App\Repositories\Eloquent\UserRepository;
use Modules\Auth\Infrastructure\Exceptions\AccountBlockedException;

final class LoginRateLimiterService
{
    protected int $maxAttemptsPerLevel = 3;
    protected array $blockDurations = [300, 600, 900, 1200];
    protected string $cachePrefix = 'login_attempts_';

    public function __construct(
        protected UserRepository $userRepository,
        protected CacheRepositoryInterface $cache,
        protected LoginBlockLogRepository $loginBlockLogRepository
    ) {}

    /**
     * @throws AccountBlockedException
     */
    public function handle(string $email): void
    {
        $this->ensureNotBlocked($email);

        $this->incrementAttempts($email);

        if ($this->tooManyAttempts($email)) {
            $this->blockUserAccount($email);
            throw new AccountBlockedException('Аккаунт заблокирован. Обратитесь в поддержку.');
        }
    }

    public function tooManyAttempts(string $email): bool
    {
        return $this->getAttempts($email) >= $this->maxAttemptsPerLevel * (count($this->blockDurations) + 1);
    }

    public function incrementAttempts(string $email): void
    {
        $key = $this->getCacheKey($email);
        $attempts = $this->getAttempts($email) + 1;
        $level = intdiv($attempts, $this->maxAttemptsPerLevel);

        $this->cache->put($key, $attempts, now()->addMinutes(60));

        if ($attempts % $this->maxAttemptsPerLevel === 0 && $level <= count($this->blockDurations)) {
            $this->cache->put($key . '_time', now(), now()->addMinutes(60));
            $this->logLevelThreshold($email, $level);
        }
    }

    public function clearAttempts(string $email): void
    {
        $this->cache->forget($this->getCacheKey($email));
        $this->cache->forget($this->getCacheKey($email) . '_time');
    }

    public function getAttempts(string $email): int
    {
        return $this->cache->get($this->getCacheKey($email), 0);
    }

    public function getBlockDuration(string $email): int
    {
        $attempts = $this->getAttempts($email);
        $level = intdiv($attempts, $this->maxAttemptsPerLevel);

        return $this->blockDurations[$level - 1] ?? -1;
    }

    protected function blockUserAccount(string $email): void
    {
        $this->userRepository->setBlocked($email);
        $this->clearAttempts($email);
    }

    protected function logLevelThreshold(string $email, int $level): void
    {
        $dto = LoginBlockLogDto::fromArray([
            'email'     => $email,
            'reason'    => "Reached level $level",
            'attempts'  => $this->getAttempts($email),
            'blocked'   => false,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $this->loginBlockLogRepository->createFromDTO($dto);
    }

    protected function getCacheKey(string $email): string
    {
        return $this->cachePrefix . sha1($email);
    }

    public function ensureNotBlocked(string $email): void
    {
        $attempts = $this->getAttempts($email);

        if ($attempts > 0 && $attempts % $this->maxAttemptsPerLevel === 0) {
            $duration = $this->getBlockDuration($email);
            $lastAttemptTime = $this->cache->get($this->getCacheKey($email) . '_time');

            if ($lastAttemptTime) {
                $blockEndsAt = $lastAttemptTime->copy()->addSeconds($duration);
                $secondsLeft = now()->utc()->diffInSeconds($blockEndsAt, false);

                if ($secondsLeft > 0) {
                    throw new AccountBlockedException("Слишком много попыток входа. Повторите через {$secondsLeft} секунд.");
                }
            }
        }
    }
}
