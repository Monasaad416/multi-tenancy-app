<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */   public function run()
    {
        $permissions = [
            'tenants-list',
            'create-tenant',
            'edit-tenant',
            'delete-tenant',
            'toggle-tenant',

            'items-list',
            'create-item',
            'edit-item',
            'delete-item',

            'bundles-list',
            'create-bundle',
            'edit-bundle',
            'delete-bundle',
            'toggle-bundle',

            
            'users-list',
            'create-user',
            'edit-user',
            'delete-user',

         ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
