<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unguard(); // Disable mass assignment
        $this->call(ProjectImportSeeder::class);
        $this->call(DailyAllowanceSeeder::class);
        Model::reguard(); // Enable mass assignment

    }
}
