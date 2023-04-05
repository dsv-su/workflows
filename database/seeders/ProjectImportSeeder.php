<?php

namespace Database\Seeders;

use App\Imports\ProjectImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ProjectImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ProjectImport, 'Projektinformation.xlsx');
    }
}
