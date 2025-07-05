<?php

namespace App\Modules\Project\Infrastructure\Database\Factories;

use App\Modules\Project\Infrastructure\Models\ProjectRole;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectRoleFactory extends Factory
{
    protected $model = ProjectRole::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
        ];
    }
}
