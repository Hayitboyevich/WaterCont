<?php

namespace Database\Seeders;

use App\Models\BuildingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BuildingType::query()->create([
            'name' => 'Ichimlik suv tozalash inshoati'
        ]);

        BuildingType::query()->create([
            'name' => 'Ichimlik suv taqsimlash inshoati'
        ]);

        BuildingType::query()->create([
            'name' => 'Ichimlik suv tarmoqlari'
        ]);
        BuildingType::query()->create([
            'name' => 'Tashkilot'
        ]);


    }
}
