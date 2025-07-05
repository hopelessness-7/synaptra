<?php

namespace Modules\Project\Http\Resources;

use App\Modules\Project\Infrastructure\Models\MemberSkill;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin MemberSkill */
class MemberSkillResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->id,
            'skill'  => $this->skill,
            'level'  => $this->level,

            'member' => new ProjectMemberResource($this->whenLoaded('member')),
        ];
    }
}
