<?php

namespace Database\Seeders;

use App\Models\SMZ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SMZSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SMZ::query()->create([
            'name' => 'SMZ talabga javob beradi',
        ]);

        SMZ::query()->create([
            'name' => 'SMZ talabga javob bermaydi',
        ]);

        SMZ::query()->create([
            'name' => 'SMZ mavjud emas',
        ]);
    }
}
