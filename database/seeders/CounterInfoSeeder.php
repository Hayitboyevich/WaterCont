<?php

namespace Database\Seeders;

use App\Models\CounterInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CounterInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CounterInfo::query()->create([
            'name' => 'O\'rnatilgan soz',
        ]);
        CounterInfo::query()->create([
            'name' => 'O\'rnatilgan nosoz',
        ]);
        CounterInfo::query()->create([
            'name' => 'O\'rnatilmagan',
        ]);
    }
}
