<?php

namespace App\Modules\Project\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberSkill extends Model
{
    protected $fillable = [
        'member_id',
        'skill',
        'level',
    ];

    public $timestamps = false;

    public function member(): BelongsTo
    {
        return $this->belongsTo(ProjectMember::class);
    }
}
