<?php

namespace Modules\Kanban\Infrastructure\Database\Factories;

use App\Models\User;
use App\Modules\Kanban\Domain\Enums\PriorityEnum;
use App\Modules\Kanban\Domain\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Modules\Kanban\Infrastructure\Models\Column;
use Modules\Kanban\Infrastructure\Models\Task;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement(StatusEnum::toArray()),
            'priority' => $this->faker->randomElement(PriorityEnum::toArray()),
            'due_date' => Carbon::now(),
            'started_at' => Carbon::now(),
            'finished_at' => Carbon::now(),
            'estimated_time' => $this->faker->randomNumber(1),
            'spent_time' => $this->faker->randomNumber(1),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
