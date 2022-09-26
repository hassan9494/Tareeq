<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Admin;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create user','guard_name' => 'admin']);
        Permission::create(['name' => 'read user','guard_name' => 'admin']);
        Permission::create(['name' => 'update user','guard_name' => 'admin']);
        Permission::create(['name' => 'delete user','guard_name' => 'admin']);

        Permission::create(['name' => 'create role','guard_name' => 'admin']);
        Permission::create(['name' => 'read role','guard_name' => 'admin']);
        Permission::create(['name' => 'update role','guard_name' => 'admin']);
        Permission::create(['name' => 'delete role','guard_name' => 'admin']);

        Permission::create(['name' => 'control slider section','guard_name' => 'admin']);
        Permission::create(['name' => 'sort sections','guard_name' => 'admin']);

        Permission::create(['name' => 'edit sections setting','guard_name' => 'admin']);
        Permission::create(['name' => 'control aboutUs section','guard_name' => 'admin']);

        Permission::create(['name' => 'control blog section','guard_name' => 'admin']);
        Permission::create(['name' => 'control partners section','guard_name' => 'admin']);
        Permission::create(['name' => 'control service section','guard_name' => 'admin']);

        Permission::create(['name' => 'control feature section','guard_name' => 'admin']);
        Permission::create(['name' => 'control products section','guard_name' => 'admin']);
        Permission::create(['name' => 'control productCategory section','guard_name' => 'admin']);
        Permission::create(['name' => 'approve product','guard_name' => 'admin']);

        Permission::create(['name' => 'control event section','guard_name' => 'admin']);
        Permission::create(['name' => 'control pages section','guard_name' => 'admin']);
        Permission::create(['name' => 'update website settings','guard_name' => 'admin']);
        Permission::create(['name' => 'control gallery section','guard_name' => 'admin']);
        Permission::create(['name' => 'control themes section','guard_name' => 'admin']);



        Role::create(['name' => 'teacher','guard_name'=>'web']);
        Role::create(['name' => 'student','guard_name'=>'web']);
        $role = Role::create(['name' => 'admin','guard_name'=>'admin']);

        $role->givePermissionTo(Permission::all());

        $demo = Admin::Create([
            'name' => 'Support User',
            'email' => 'support@aisent.net',
            'password' => bcrypt('support123'),
        ]);
        $demo->save();
        $demo->assignRole('admin');
    }
}
