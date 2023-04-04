<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ryan Dias',
            'email' => 'ryan@test.se',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Gunnar Wettergren',
            'email' => 'gunnar@test.se',
            'password' => Hash::make('123456'),
        ]);
    }
}
