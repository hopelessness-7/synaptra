<?php

namespace App\Modules\Project\Infrastructure\Database\Factories;

use App\Modules\Project\Infrastructure\Models\MemberMetric;
use App\Modules\Project\Infrastructure\Models\ProjectMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberMetricFactory extends Factory
{
    protected $model = MemberMetric::class;

    public function definition(): array
    {
        return [
            'tasks_completed' => $this->faker->randomNumber(),
            'avg_task_time' => $this->faker->randomFloat(),
            'total_work_time' => $this->faker->randomFloat(),
            'quality_score' => $this->faker->randomFloat(),
            'activity_score' => $this->faker->randomFloat(),

            'member_id' => ProjectMember::factory(),
        ];
    }
}
