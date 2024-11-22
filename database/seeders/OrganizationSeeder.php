<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::query()->create([
            'name' => "Inshoatga kirish joyi",
        ]);
        Organization::query()->create([
            'name' => "Inshoatdan chiqish joyi",
        ]);

        Organization::query()->create([
            'name' => "Rezervuar",
        ]);

        Organization::query()->create([
            'name' => "Suv minorasi",
        ]);

        Organization::query()->create([
            'name' => "Yer osti tik quduqlar",
        ]);

    }
}
