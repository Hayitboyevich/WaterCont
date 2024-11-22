<?php

namespace Database\Seeders;

use App\Models\Consumer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsumerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Consumer::create([
            'name' => 'Jismoniy shaxs'
        ]);

        Consumer::create([
            'name' => 'Yuridik shaxs'
        ]);
    }
}
