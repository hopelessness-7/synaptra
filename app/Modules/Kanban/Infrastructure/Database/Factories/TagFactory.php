<?php

namespace App\Modules\Kanban\Infrastructure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Kanban\Infrastructure\Models\Tag;
use Modules\Kanban\Infrastructure\Models\Task;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'color' => $this->faker->word(),

            'task_id' => Task::factory(),
        ];
    }
}
