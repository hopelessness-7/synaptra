<?php

namespace App\Modules\Auth\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class JwtBlacklist extends Model
{
    protected $table = 'jwt_blacklist';

    public $fillable = [
        'token_hash',
        'expires_at',
    ];


    public array $dates = [
        'expires_at',
    ];
}
