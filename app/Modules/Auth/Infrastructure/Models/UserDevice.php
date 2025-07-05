<?php

namespace App\Modules\Auth\Infrastructure\Models;

use App\Models\User;
use App\Traits\HasModuleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDevice extends Model
{
    use HasFactory;
    use HasModuleFactory {
        HasModuleFactory::newFactory insteadof HasFactory;
    }

    protected $fillable = [
        'user_id',
        'device_hash',
        'device_name',
        'is_confirmed',
        'last_used_at',
    ];

    protected function casts(): array
    {
        return [
            'last_used_at' => 'datetime',
            'is_confirmed' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
