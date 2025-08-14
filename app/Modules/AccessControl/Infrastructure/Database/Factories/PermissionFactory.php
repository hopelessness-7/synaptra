<?php

namespace Modules\AccessControl\Infrastructure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\AccessControl\Infrastructure\Models\Permission;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function __construct()
    {
        parent::__construct();

        $this->faker = \Faker\Factory::create();
    }

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
        ];
    }
}
