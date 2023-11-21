<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $alum = Role::create(['name' => 'alum']);

        Permission::create (['name' => 'home']) -> syncRoles([$admin, $alum]);
        Permission::create (['name' => 'welcome']) -> syncRoles([$admin, $alum]);
        Permission::create (['name' => 'categoria.index']) -> syncRoles([$admin, $alum]);
        Permission::create (['name' => 'categoria.create'])-> assignRole($admin);
        Permission::create (['name' => 'categoria.edit'])-> assignRole($admin);
        Permission::create (['name' => 'categoria.show']) -> syncRoles([$admin, $alum]);
        Permission::create (['name' => 'categoria.store'])-> assignRole($admin);
        Permission::create (['name' => 'categoria.update'])-> assignRole($admin);
        Permission::create (['name' => 'categoria.destroy'])->assignRole($admin);

        Permission::create (['name' => 'libro.index']) -> syncRoles([$admin,$alum]);
        Permission::create (['name' => 'libro.create'])->assignRole($admin);
        Permission::create (['name' => 'libro.edit'])->assignRole($admin);
        Permission::create (['name' => 'libro.show']) -> syncRoles([$admin, $alum]);
        Permission::create (['name' => 'libro.store'])->assignRole($admin);
        Permission::create (['name' => 'libro.update'])->assignRole($admin);
        Permission::create (['name' => 'libro.destroy'])->assignRole($admin);
    }
}
