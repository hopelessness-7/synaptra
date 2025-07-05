<?php

namespace App\Modules\Project\Infrastructure\Database\Factories;

use App\Modules\Project\Domain\Enums\TypeProjectEnum;
use App\Modules\Project\Infrastructure\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'git_repo_url' => $this->faker->url(),
            'type' => $this->faker->randomElement(TypeProjectEnum::toArray()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
