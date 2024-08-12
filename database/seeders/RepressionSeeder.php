<?php

namespace Database\Seeders;

use App\Imports\RepressionImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class RepressionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regPath = storage_path() . "/excel/repression.xlsx";

        Excel::import(new RepressionImport, $regPath);
    }
}
