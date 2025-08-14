<?php

namespace Modules\Auth\Infrastructure\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AccessDeniedException extends HttpException
{
    public function __construct(string $message = 'You do not have permission to perform this action')
    {
        parent::__construct(403, $message);
    }

    public static function forRole(string $role): self
    {
        return new self("Access denied. Required role: {$role}");
    }

    public static function forPermission(string $permission): self
    {
        return new self("Access denied. Required permission: {$permission}");
    }
}
