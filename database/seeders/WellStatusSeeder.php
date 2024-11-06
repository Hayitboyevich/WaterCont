<?php

namespace Database\Seeders;

use App\Models\WellStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WellStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WellStatus::create([
            'name' => 'Ishchi holatda',
        ]);
        WellStatus::create([
            'name' => 'Zahirada',
        ]);

        WellStatus::create([
            'name' => 'Ta’mir talab',
        ]);
        WellStatus::create([
            'name' => 'Yaroqsiz',
        ]);
    }
}
