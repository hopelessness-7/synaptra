<?php

namespace App\Modules\AccessControl\Test\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AccessControl\Infrastructure\Models\Role;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_role_by_slug_and_name()
    {
        $role = Role::create([
            'slug' => 'admin',
            'name' => 'Administrator',
        ]);

        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertTrue($user->hasRole('admin'));
        $this->assertTrue($user->hasRole('Administrator'));
        $this->assertFalse($user->hasRole('editor'));
    }

    public function test_user_has_any_role()
    {
        $role = Role::create([
            'slug' => 'moderator',
            'name' => 'Moderator',
        ]);

        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertTrue($user->hasAnyRole(['admin', 'moderator']));
        $this->assertFalse($user->hasAnyRole(['admin', 'editor']));
    }
}
