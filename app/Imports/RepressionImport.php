<?php

namespace App\Imports;

use App\Models\Repression;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Excel;

class RepressionImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Repression::query()->create([
               'name' => $row['name'],
               'description' => $row['description'],
                'protocol_type_id' => 1
            ]);
        }
    }


}
