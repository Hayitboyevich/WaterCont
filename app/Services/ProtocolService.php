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
        if ($data->protocol_type_id == 4) {
            return $this->saveWater($data);
        }
        if ($data->protocol_type_id == 5) {
            return $this->saveContract($data);
        }

        if ($data->protocol_type_id == 6) {
            return $this->saveTechnic($data);
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
                    'chlorination_device_effective' => $item['chlorination_device_effective'] ?? null,
                    'chlorination_device_defective' => $item['chlorination_device_defective'] ?? null,
                    'bactericidal_device_effective' => $item['bactericidal_device_effective'] ?? null,
                    'bactericidal_device_defective' => $item['bactericidal_device_defective'] ?? null,
                    'other_device_effective' => $item['other_device_effective'] ?? null,
                    'other_device_defective' => $item['other_device_defective'] ?? null,
                    'not_device' => $item['not_device'] ?? false,
                    'smz_id' => $item['smz_id'],
                    'debit_id' => $item['debit_id'],
                    'repression_id' => $item['repression_id'],
                    'amount' => $item['amount'],
                    'fixed_date' => $item['fixed_date'],
                ]);

                if (!empty($item['images'])) {
                    foreach ($item['images'] as $image) {
                        $path = $image->store('well/images', 'public');
                        $well->images()->create(['url' => $path]);
                    }
                }
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

    private function saveWater($data)
    {
        $protocol = Protocol::query()->create($data->except(['images', 'wells']));
        if ($data->hasFile('images')) {
            $this->storeImages($protocol, $data->file('images'));
        }

        return $protocol;
    }

    private function saveContract($data)
    {
        $protocol = Protocol::query()->create($data->except(['images', 'wells']));
        if ($data->hasFile('images')) {
            $this->storeImages($protocol, $data->file('images'));
        }

        return $protocol;
    }

    private function saveTechnic($data)
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
