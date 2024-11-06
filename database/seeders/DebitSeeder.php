<?php

namespace Database\Seeders;

use App\Models\Debit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Debit::query()->create([
            'name' => '1 metrdan - 5 metrgacha',
        ]);

        Debit::query()->create([
            'name' => '5 metrdan - 10 metrgacha ',
        ]);

        Debit::query()->create([
            'name' => '10 metrdan yuqori',
        ]);
    }
}
