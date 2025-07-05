<?php

namespace App\Modules\Auth\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class LoginBlockLog extends Model
{
    protected $table = 'login_block_logs';

    protected $fillable = [
        'user_agent',
        'ip_address',
        'email',
        'reason',
        'attempts',
        'blocked'
    ];
}
