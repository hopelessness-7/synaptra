<?php

namespace App\Modules\Project\Infrastructure\Database\Factories;

use App\Modules\Project\Infrastructure\Models\MemberSkill;
use App\Modules\Project\Infrastructure\Models\ProjectMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberSkillFactory extends Factory
{
    protected $model = MemberSkill::class;

    public function definition(): array
    {
        return [
            'skill' => $this->faker->word(),
            'level' => $this->faker->randomNumber(),

            'member_id' => ProjectMember::factory(),
        ];
    }
}
