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
            'email' => 'ryan@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Gunnar Wettergren',
            'email' => 'gunnarw@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Maria Lind',
            'email' => 'lind@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);
    }
}
