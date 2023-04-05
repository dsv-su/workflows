<?php

namespace Database\Seeders;

use App\Services\Skatteverket;
use Illuminate\Database\Seeder;

class DailyAllowanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skatteverket = new Skatteverket();
        $skatteverket->getCountry();
    }
}
