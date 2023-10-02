<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User permissions
            ['name' => 'user index'],
            ['name' => 'user show'],
            ['name' => 'user store'],
            ['name' => 'user update'],
            ['name' => 'user destroy'],
            ['name' => 'user activate'],
            ['name' => 'user deactivate'],

            // Banner permissions
            ['name' => 'banner index'],
            ['name' => 'banner show'],
            ['name' => 'banner store'],
            ['name' => 'banner update'],
            ['name' => 'banner destroy'],
            ['name' => 'banner types'],
            ['name' => 'banner delete_images'],

            // Section permissions
            ['name' => 'section index'],
            ['name' => 'section show'],
            ['name' => 'section store'],
            ['name' => 'section update'],
            ['name' => 'section destroy'],
            ['name' => 'section types'],
            ['name' => 'section delete_images'],

            // Post permission
            ['name' => 'post index'],
            ['name' => 'post show'],
            ['name' => 'post store'],
            ['name' => 'post update'],
            ['name' => 'post destroy'],
            ['name' => 'post delete_images'],

            // Message permissions
            ['name' => 'message index'],
            ['name' => 'message show'],
            ['name' => 'message destroy'],
            ['name' => 'message archived'],
            ['name' => 'message restore'],

            // Subscription permissions
            ['name' => 'subscription index']
        ];

        $admin = Role::firstOrCreate(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $_permission = Permission::firstOrCreate($permission);
            $admin->givePermissionTo($_permission);
        }

        $user = User::factory()->create([
            'name' => 'Lasha Gagnidze',
            'email' => 'lashadeveloper@gmail.com'
        ]);
        $user->assignRole('admin');

        $contentManager = Role::firstOrCreate(['name' => 'content manager']);
        $contentManager->syncPermissions([
            'banner index',
            'banner show',
            'banner store',
            'banner update',
            'banner destroy',
            'banner types',
            'banner delete_images',

            'section index',
            'section show',
            'section store',
            'section update',
            'section destroy',
            'section types',
            'section delete_images',

            'post index',
            'post show',
            'post store',
            'post update',
            'post destroy',
            'post delete_images'
        ]);
        $user1 = User::factory()->create([
            'name' => 'Lasha Gagnidze1',
            'email' => 'lashadeveloper1@gmail.com'
        ]);
        $user1->assignRole('content manager');

        $writer = Role::firstOrCreate(['name' => 'writer']);
        $writer->syncPermissions([
            'post index',
            'post show',
            'post store',
            'post update',
            'post destroy',
            'post delete_images'
        ]);
        $user2 = User::factory()->create([
            'name' => 'Lasha Gagnidze2',
            'email' => 'lashadeveloper2@gmail.com'
        ]);
        $user2->assignRole('writer');
    }
}
