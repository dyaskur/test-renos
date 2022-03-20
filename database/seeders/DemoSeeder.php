<?php

namespace Database\Seeders;

use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'mobil',
            'mobil/toyota',
            'mobil/toyota/avanza',
            'mobil/toyota/innova',
            'mobil/daihatsu',
            'mobil/daihatsu/xenia',
            'mobil/daihatsu/ayla',
            'mobil/nissan',
            'mobil/nissan/juke',
            'mobil/nissan/livina',
            'motor',
            'motor/honda',
            'motor/honda/vario',
            'motor/honda/cbr',
            'motor/yamaha',
            'motor/yamaha/mio',
            'motor/yamaha/r15',
            'motor/suzuki',
            'motor/suzuki/spin',
            'motor/suzuki/satria',
        ];
        foreach ($data as $key => $value) {
            $explode    = explode('/', $value);
            $type_name  = $explode[0];
            $brand_name = $explode[1] ?? null;
            $model_name = $explode[2] ?? null;
            $type       = VehicleType::firstOrCreate(['name' => $type_name]);
            if ($brand_name) {
                $brand = VehicleBrand::query()->firstOrCreate(['name' => $brand_name]);
                if ($model_name) {
                    $model = VehicleModel::query()->firstOrCreate(
                        [
                            'name'             => $model_name,
                            'vehicle_brand_id' => $brand->id,
                            'vehicle_type_id'  => $type->id,
                        ]
                    );
                }
            }
        }
    }
}
