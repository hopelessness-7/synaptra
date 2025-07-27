<?php

namespace App\Modules\Project\Infrastructure\Database\Factories;

use App\Models\User;
use App\Modules\Project\Domain\Enums\GradeEnum;
use App\Modules\Project\Domain\Enums\SpecializationEnum;
use App\Modules\Project\Infrastructure\Models\ProjectMember;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProjectMemberFactory extends Factory
{
    protected $model = ProjectMember::class;

    public function definition(): array
    {
        return [
            'grade' => $this->faker->randomElement(GradeEnum::toArray()),
            'specialization' => $this->faker->randomElement(SpecializationEnum::toArray()),
            'load' => $this->faker->randomFloat(),
            'is_available' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
