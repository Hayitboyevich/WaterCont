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
           'name' => 'Аniqlangan noqonuniy ulanmalar',
        ]);

        ProtocolType::query()->create([
            'name' => 'Davlat dasturlari doirasida burgʼulangan quduqlar',
        ]);

        ProtocolType::query()->create([
            'name' => 'Аniqlangan avariya holatlari',
        ]);

        ProtocolType::query()->create([
            'name' => 'Ichimlik suv sifati tahlillari',
        ]);

        ProtocolType::query()->create([
            'name' => 'Shartnomaviy munosabatlarga oid axborotlar',
        ]);

        ProtocolType::query()->create([
            'name' => 'Texnik shartlar to\'g\'risidagi ma\'lumotlar',
        ]);
    }
}
