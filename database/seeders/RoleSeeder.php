<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()->create(['name' => 'Admin']);
        Role::query()->create(['name' => 'Kadr']);
        Role::query()->create(['name' => 'Hududiy Inspeksiya boshligi']);
        Role::query()->create(['name' => 'Inspektor']);
        Role::query()->create(['name' => 'Operator']);
    }
}
