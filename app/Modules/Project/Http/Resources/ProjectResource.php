<?php

namespace Modules\Project\Http\Resources;

use App\Modules\Project\Infrastructure\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Project */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'slug'         => $this->slug,
            'description'  => $this->description,
            'git_repo_url' => $this->git_repo_url,
            'type'         => $this->type,
        ];
    }
}
