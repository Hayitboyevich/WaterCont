<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->truncate();
        User::query()->create([
            'name' => 'Super Admin',
            'role_id' => 1,
            'login' => 'super-admin',
            'phone' => '998911234561',
            'pinfl' => 12345678912341,
            'status' => true,
            'password' => Hash::make('super-admin')
        ]);

        User::query()->create([
            'name' => 'Kadr',
            'role_id' => 2,
            'login' => 'kadr',
            'phone' => '998916424257',
            'pinfl' => 1234567891232,
            'status' => true,
            'region_id' => 1,
            'password' => Hash::make('reskadr123')
        ]);
    }
}
