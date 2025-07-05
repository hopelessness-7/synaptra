<?php

namespace App\Modules\Kanban\Infrastructure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Kanban\Infrastructure\Models\Board;
use Modules\Kanban\Infrastructure\Models\Column;

class ColumnFactory extends Factory
{
    protected $model = Column::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'position' => $this->faker->numberBetween(1, 3),
        ];
    }
}
