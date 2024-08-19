<?php

namespace Database\Seeders;

use App\Models\ProtocolStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProtocolStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meta = [
            'Yangi',
            'Qayta yuborilgan',
            'Rad etilgan',
            'Qabul qilingan'
        ];

        foreach ($meta as  $value) {
            ProtocolStatus::create([
                'name' => $value,
            ]);
        }
    }
}
