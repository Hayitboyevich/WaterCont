<?php

namespace Database\Seeders;

use App\Models\ViolatorType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViolatorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meta = [
            'Yuridik shaxs',
            'Jismoniy shaxs'
        ];

        foreach ($meta as $value) {
            ViolatorType::create([
                'name' => $value,
            ]);
        }
    }
}
