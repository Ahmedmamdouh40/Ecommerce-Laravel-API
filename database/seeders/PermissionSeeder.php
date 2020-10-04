<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
   
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'show products']);

        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'delete categories']);
        Permission::create(['name' => 'show categories']);

        Permission::create(['name' => 'edit brands']);
        Permission::create(['name' => 'create brands']);
        Permission::create(['name' => 'delete brands']);
        Permission::create(['name' => 'show brands']);

        // Give permisson toooooooooooooo
        $customer = Role::create(['name' => 'customer']);
        $customer->givePermissionTo('show products');
        $customer->givePermissionTo('show categories');
        $customer->givePermissionTo('show brands');


        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('edit products');
        $admin->givePermissionTo('create products');
        $admin->givePermissionTo('delete products');
        $admin->givePermissionTo('edit categories');
        $admin->givePermissionTo('create categories');
        $admin->givePermissionTo('delete categories');
        $admin->givePermissionTo('edit brands');
        $admin->givePermissionTo('create brands');
        $admin->givePermissionTo('delete brands');
        
        $userAdmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);

        $userAdmin->assignRole($admin);
    }
}
