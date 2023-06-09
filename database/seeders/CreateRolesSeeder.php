<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'staff']);
        User::find(1)->assignRole($role);
        $role = Role::create(['name' => 'project-leader']);
        User::find(2)->assignRole($role);
        User::find(7)->assignRole($role);
        User::find(8)->assignRole($role);
        $role = Role::create(['name' => 'unit-head']);
        User::find(3)->assignRole($role);
        User::find(4)->assignRole($role);
        User::find(5)->assignRole($role);
        User::find(6)->assignRole($role);
        $role = Role::create(['name' => 'financial-manager']);
        User::find(9)->assignRole($role);
    }
}
