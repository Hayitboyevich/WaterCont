<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CounterInfoSeeder::class,
            WellStatusSeeder::class,
            SMZSeeder::class,
            DebitSeeder::class,
            RepressionSeeder::class,
            ViolationSeeder::class,
            ViolatorTypeSeeder::class,
            RegionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ProtocolStatusSeeder::class,
            ProtocolTypeSeeder::class,
            BuildingTypeSeeder::class,
            ConsumerSeeder::class,
            MeasureSeeder::class,
            OrganizationSeeder::class,
            StandartNormSeeder::class
        ]);
    }
}
