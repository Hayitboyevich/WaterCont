<?php

namespace Database\Seeders;

use App\Models\StandartNorm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StandartNormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StandartNorm::query()->create([
            'name' => "Umumiy mikroblar soni"
        ]);

        StandartNorm::query()->create([
            'name' => "Ichak tayoqchalari soni(koli-indeks)"
        ]);
        StandartNorm::query()->create([
            'name' => "Esherexii(Yangi fekal zararlanganlik ko‘rsatkichi)"
        ]);
        StandartNorm::query()->create([
            'name' => "Kolifaglar"
        ]);

        StandartNorm::query()->create([
            'name' => "Oddiy potagen ichak bakteriyalari(lyambliy,Dizenteriya amyobasi"
        ]);
        StandartNorm::query()->create([
            'name' => "Gelmit tuxumlari"
        ]);

        StandartNorm::query()->create([
            'name' => "Alyuminiy"
        ]);

        StandartNorm::query()->create([
            'name' => "Berilliy"
        ]);

        StandartNorm::query()->create([
            'name' => "Bor"
        ]);

        StandartNorm::query()->create([
            'name' => "Kadmiy"
        ]);
        StandartNorm::query()->create([
            'name' => "Molibden"
        ]);

        StandartNorm::query()->create([
            'name' => "Margimush"
        ]);

        StandartNorm::query()->create([
            'name' => "Nikel"
        ]);

        StandartNorm::query()->create([
            'name' => "Nitritlar"
        ]);

        StandartNorm::query()->create([
            'name' => "Nitratlar"
        ]);

        StandartNorm::query()->create([
            'name' => "Simob"
        ]);
        StandartNorm::query()->create([
            'name' => "Qo‘rg‘oshin"
        ]);

        StandartNorm::query()->create([
            'name' => "Selen"
        ]);

        StandartNorm::query()->create([
            'name' => "Stronsiy"
        ]);

        StandartNorm::query()->create([
            'name' => "Ftor"
        ]);

        StandartNorm::query()->create([
            'name' => "Xrom"
        ]);

        StandartNorm::query()->create([
            'name' => "Benzol"
        ]);
        StandartNorm::query()->create([
            'name' => "Benz(a)piren"
        ]);

        StandartNorm::query()->create([
            'name' => "Ammiak"
        ]);
        StandartNorm::query()->create([
            'name' => "Pestitsitlar"
        ]);

        StandartNorm::query()->create([
            'name' => "Ta’mi"
        ]);
        StandartNorm::query()->create([
            'name' => "Xidi"
        ]);

        StandartNorm::query()->create([
            'name' => "Loyqaligi"
        ]);

        StandartNorm::query()->create([
            'name' => "Rangi"
        ]);

        StandartNorm::query()->create([
            'name' => "Vodorod soni-rN"
        ]);

        StandartNorm::query()->create([
            'name' => "Umumiy menerallashuvi(quruq qoldiq)"
        ]);
        StandartNorm::query()->create([
            'name' => "Temir"
        ]);

        StandartNorm::query()->create([
            'name' => "Umumiy qattiqlik"
        ]);

        StandartNorm::query()->create([
            'name' => "Marganes"
        ]);

        StandartNorm::query()->create([
            'name' => "Mis"
        ]);

        StandartNorm::query()->create([
            'name' => "Polifasfatlar"
        ]);

        StandartNorm::query()->create([
            'name' => "Sulfatlar"
        ]);
        StandartNorm::query()->create([
            'name' => "Xloridlar"
        ]);

        StandartNorm::query()->create([
            'name' => "Rux"
        ]);

        StandartNorm::query()->create([
            'name' => "SPAV(PAV)"
        ]);

        StandartNorm::query()->create([
            'name' => "Fenol"
        ]);
        StandartNorm::query()->create([
            'name' => "Neft maxsulotlari"
        ]);
        StandartNorm::query()->create([
            'name' => "Bariy"
        ]);
        StandartNorm::query()->create([
            'name' => "Permanganat ishqorlanish"
        ]);
        StandartNorm::query()->create([
            'name' => "Sianitlar"
        ]);
    }
}
