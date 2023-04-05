<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard(); // Disable mass assignment

        $this->call(UserSeeder::class);
        $this->call(CreateRolesSeeder::class);
        $this->call(ProjectImportSeeder::class);
        $this->call(DailyAllowanceSeeder::class);
        Model::reguard(); // Enable mass assignment
    }
}
