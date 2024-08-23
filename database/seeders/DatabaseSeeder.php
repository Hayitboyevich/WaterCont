<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RepressionSeeder::class,
            ViolationSeeder::class,
            ViolatorTypeSeeder::class,
            RegionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ProtocolStatusSeeder::class,
        ]);
    }
}
