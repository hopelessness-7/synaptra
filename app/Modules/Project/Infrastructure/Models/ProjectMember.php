<?php

namespace App\Modules\Project\Infrastructure\Models;

use App\Models\User;
use App\Modules\Project\Domain\Enums\GradeEnum;
use App\Modules\Project\Domain\Enums\SpecializationEnum;
use App\Traits\HasModuleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMember extends Model
{
    use HasFactory;
    use HasModuleFactory {
        HasModuleFactory::newFactory insteadof HasFactory;
    }

    protected $fillable = [
        'project_id',
        'user_id',
        'grade',
        'specialization',
        'load',
        'is_available'
    ];

    protected $casts = [
        'grade' => GradeEnum::class,
        'specialization' => SpecializationEnum::class
    ];

    public function project():  BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
