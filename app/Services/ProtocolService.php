<?php

namespace App\Services;

use App\Models\Protocol;
use App\Models\Well;

class ProtocolService
{
    public function saveProtocol($data)
    {
        if ($data->protocol_type_id == 1) {
            return $this->saveSimple($data);
        }
        if ($data->protocol_type_id == 2) {
            return $this->saveWell($data);
        }
        if ($data->protocol_type_id == 3) {
            return $this->saveCrash($data);
        }
    }

    private function saveSimple($data)
    {
        $protocol = Protocol::query()->create($data->except(['images', 'wells']));
        if ($data->hasFile('images')) {
            $this->storeImages($protocol, $data->file('images'));
        }

        return $protocol;
    }

    private function saveWell($data)
    {

        $protocol = Protocol::query()->create($data->except(['images', 'wells']));
        if ($data->wells) {
            foreach ($data->wells as $item) {
                $well = Well::query()->create([
                    'protocol_id' => $protocol->id,
                    'object_name' => $item['object_name'],
                    'well_status_id' => $item['well_status_id'],
                    'technical_passport' => $item['technical_passport'],
                    'license' => $item['license'],
                    'counter_info_id' => $item['counter_info_id'],
                    'chlorination_device' => $item['chlorination_device'],
                    'bactericidal_device' => $item['bactericidal_device'],
                    'other_device' => $item['other_device'],
                    'not_device' => $item['not_device'],
                    'smz_id' => $item['smz_id'],
                    'debit_id' => $item['debit_id'],
                    'repression_id' => $item['repression_id'],
                    'amount' => $item['amount'],
                    'fixed_date' => $item['fixed_date'],
                ]);
            }
        }
        return $protocol;
    }

    private function saveCrash($data)
    {
        $protocol = Protocol::query()->create($data->except(['images', 'wells']));
        if ($data->hasFile('images')) {
            $this->storeImages($protocol, $data->file('images'));
        }
        return $protocol;
    }

    private function storeImages(Protocol $protocol, $images)
    {
        foreach ($images as $image) {
            $imagePath = $image->store('protocols', 'public');
            $protocol->images()->create(['url' => $imagePath]);
        }
    }

}
