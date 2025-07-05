<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserStatusEnum;
use App\Modules\Auth\Infrastructure\Models\UserDevice;
use App\Modules\Common\Domain\Enums\OnboardingStep;
use App\Modules\Common\Domain\Traits\Searchable;
use App\Modules\Project\Infrastructure\Models\Project;
use App\Modules\Project\Infrastructure\Models\ProjectMember;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Searchable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'onboarding_step',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatusEnum::class
        ];
    }

    public function devices(): HasMany
    {
        return $this->hasMany(UserDevice::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_members', 'user_id', 'project_id');
    }


    public function projectMembers(): HasMany
    {
        return $this->hasMany(ProjectMember::class);
    }

    public function getOnboardingStepEnumAttribute(): ?OnboardingStep
    {
        return $this->onboarding_step
            ? OnboardingStep::from($this->onboarding_step)
            : null;
    }

    public function getJWTIdentifier(): int|string
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ];
    }
}
