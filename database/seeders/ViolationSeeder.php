<?php

namespace Database\Seeders;

use App\Imports\RepressionImport;
use App\Imports\ViolationImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regPath = storage_path() . "/excel/violations.xlsx";

        Excel::import(new ViolationImport(), $regPath);
    }
}
