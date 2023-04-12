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
            'name' => 'Peter Idestam-Almquist (ACT)',
            'email' => 'pi@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Janis Stirna (IS)',
            'email' => 'js@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Henricus Verhagen (IDEAL)',
            'email' => 'verhagen@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Tony Lindgren (Systemanalys och Säkerhet)',
            'email' => 'tony@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Tuija Lehtonen',
            'email' => 'tuija@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Stefan Möller',
            'email' => 'sm@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Ekonomiansvarig',
            'email' => 'ekonomi@dsv.su.se',
            'password' => Hash::make('123456'),
        ]);

    }
}
