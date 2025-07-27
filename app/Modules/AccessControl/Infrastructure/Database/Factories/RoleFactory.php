<?php

namespace Modules\AccessControl\Infrastructure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\AccessControl\Infrastructure\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function __construct()
    {
        parent::__construct();

        $this->faker = \Faker\Factory::create();
    }

    public function definition(): array
    {
        return [
            'name' => 'Example Role Name',
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
        ];
    }
}
