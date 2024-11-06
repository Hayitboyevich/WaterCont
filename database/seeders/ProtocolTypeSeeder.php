<?php

namespace Database\Seeders;

use App\Models\ProtocolType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProtocolTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProtocolType::query()->create([
           'name' => 'Oddiy',
        ]);

        ProtocolType::query()->create([
            'name' => 'Quduq',
        ]);

        ProtocolType::query()->create([
            'name' => 'Avariya',
        ]);
    }
}
