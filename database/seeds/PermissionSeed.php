<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create_roles']);
        Permission::create(['name' => 'update_roles']);
        Permission::create(['name' => 'show_roles']);
        Permission::create(['name' => 'delete_roles']);

        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'update_users']);
        Permission::create(['name' => 'show_users']);
        Permission::create(['name' => 'delete_users']);

        Permission::create(['name' => 'create_menus']);
        Permission::create(['name' => 'update_menus']);
        Permission::create(['name' => 'show_menus']);
        Permission::create(['name' => 'delete_menus']);

        Permission::create(['name' => 'create_pages']);
        Permission::create(['name' => 'update_pages']);
        Permission::create(['name' => 'show_pages']);
        Permission::create(['name' => 'delete_pages']);

        Permission::create(['name' => 'create_blogs']);
        Permission::create(['name' => 'update_blogs']);
        Permission::create(['name' => 'show_blogs']);
        Permission::create(['name' => 'delete_blogs']);

        Permission::create(['name' => 'create_categories']);
        Permission::create(['name' => 'update_categories']);
        Permission::create(['name' => 'show_categories']);
        Permission::create(['name' => 'delete_categories']);

    }
}
