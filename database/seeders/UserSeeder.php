<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
           'name' => 'Super Admin',
            'role_id' => 1,
            'phone' => '998911234561',
            'pinfl' => 12345678912341,
            'status' => true,
            'password' => Hash::make(998911234561)
        ]);

        User::query()->create([
            'name' => 'Kadr',
            'role_id' => 2,
            'phone' => '998911234562',
            'pinfl' => 1234567891232,
            'status' => true,
            'region_id' => 1,
            'password' => Hash::make(998911234562)
        ]);


        User::query()->create([
            'name' => 'Hududiy Inspektor',
            'role_id' => 3,
            'phone' => '998911234563',
            'pinfl' => 1234567891233,
            'status' => true,
            'region_id' => 1,
            'password' => Hash::make(998911234563)
        ]);

        User::query()->create([
            'name' => 'Inspektor',
            'role_id' => 4,
            'phone' => '998911234564',
            'pinfl' => 1234567891234,
            'status' => true,
            'region_id' => 1,
            'password' => Hash::make(998911234564)
        ]);
    }
}
