<?php

namespace App\Modules\Common\Application\UseCases;

use App\Repositories\Eloquent\UserRepository;

class FinishOnboarding
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ){}

    public function execute(): void
    {
        $this->userRepository->update(auth()->id(), ['onboarding_step' => null]);
    }
}
