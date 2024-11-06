<?php

namespace Database\Seeders;

use App\Imports\RepressionImport;
use App\Models\Repression;
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

        Repression::query()->create([
            'name' => 'Ko\'rsatma xati berildi',
            'protocol_type_id' => 3,
        ]);

        Repression::query()->create([
            'name' => 'Ko\'rsatma xati berildi',
            'protocol_type_id' => 3,
        ]);
    }
}
