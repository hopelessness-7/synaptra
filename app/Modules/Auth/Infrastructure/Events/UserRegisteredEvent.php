<?php

namespace Modules\Auth\Infrastructure\Events;

use App\Models\User;

class UserRegisteredEvent
{
    public function __construct(public User $user){}
}
