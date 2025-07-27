<?php

namespace App\Modules\AccessControl\Test\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\AccessControl\Infrastructure\Models\Permission;
use Modules\AccessControl\Infrastructure\Models\Role;
use Tests\TestCase;

class UserPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_permission_by_slug_and_name()
    {
        $permission = Permission::create([
            'slug' => 'edit_articles',
            'name' => 'Edit Articles',
        ]);

        $role = Role::factory()->create();
        $role->permissions()->attach($permission);

        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertTrue($user->hasPermission('edit_articles'));
        $this->assertTrue($user->hasPermission('Edit Articles'));
        $this->assertFalse($user->hasPermission('delete_articles'));
    }

    public function test_user_has_any_permission()
    {
        $permission1 = Permission::create(['slug' => 'publish_articles', 'name' => 'Publish Articles']);
        $permission2 = Permission::create(['slug' => 'delete_articles',  'name' => 'Delete Articles']);

        $role = Role::factory()->create();
        $role->permissions()->attach([$permission1->id]);

        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertTrue($user->hasAnyPermission(['publish_articles', 'edit_articles']));
        $this->assertFalse($user->hasAnyPermission(['delete_articles', 'edit_articles']));
    }
}
