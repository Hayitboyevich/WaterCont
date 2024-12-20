<?php

namespace Database\Seeders;

use App\Models\Measure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Measure::create([
            'name' => 'Ko\'rsatma xati berildi'
        ]);

        Measure::create([
            'name' => 'Ogohlantirish berildi'
        ]);

    }
}
