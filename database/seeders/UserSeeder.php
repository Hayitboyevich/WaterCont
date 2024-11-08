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
            'phone' => '998917824757',
            'pinfl' => 1234567891232,
            'status' => true,
            'region_id' => 1,
            'password' => Hash::make('reskadr123')
        ]);

        User::query()->create([
            'name' => 'Shaxzod',
            'middle_name' => 'Muhammad o\'g\'li',
            'last_name' => 'Eshmurodov',
            'role_id' => 4,
            'login' => 'shaxzod',
            'phone' => '998945320044',
            'pinfl' => 21345454545453,
            'status' => true,
            'region_id' => 1,
            'password' => Hash::make('shaxzod')
        ]);

        User::query()->create([
            'name' => 'Shahzod',
            'middle_name' => 'Hayitboyevich',
            'last_name' => 'Ruziev',
            'role_id' => 4,
            'login' => 'shahzod',
            'phone' => '998337071727998337071727',
            'pinfl' => 31703975270028,
            'status' => true,
            'region_id' => 1,
            'password' => Hash::make('shaxzod')
        ]);
    }
}
