<?php

namespace App\Modules\Project\Infrastructure\Models;

use App\Modules\Project\Domain\Enums\TypeProjectEnum;
use App\Traits\HasModuleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    use HasModuleFactory {
        HasModuleFactory::newFactory insteadof HasFactory;
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'git_repo_url',
        'type'
    ];


    protected $casts = [
        'type' => TypeProjectEnum::class,
    ];

    public function members(): HasMany
    {
        return $this->hasMany(ProjectMember::class);
    }
}
