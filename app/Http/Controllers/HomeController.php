<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    //
    public function welcome(Request $request)
    {
        $data = [];

        $models = VehicleModel::query();

        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $explode = explode('/', $keyword);
            $type    = $explode[0];
            $brand   = $explode[1] ?? null;
            if ($brand) {
                $models->whereHas('vehicleBrand', function($query) use ($brand) {
                    $query->where('name', $brand);
                });
            }
            if ($type) {
                $models->whereHas('vehicleType', function($query) use ($type) {
                    $query->where('name', $type);
                });
            }
        }

        $models        = $models->get();
        $models        = $models->map(function($model) {
            return [
                'name'               => $model->name,
                'vehicle_brand_name' => $model->vehicleBrand->name,
                'vehicle_type_name'  => $model->vehicleType->name,
            ];
        });
        $types         = $models->groupBy('vehicle_type_name', true)->map(function($brand) use (&$results) {
            return $brand->groupBy('vehicle_brand_name')->map(function($type) {
                return $type->groupBy->name->map(fn() => null);
            });
        });
        $data['items'] = $this->toList($types);

        return view('welcome', $data);
    }


    private function toList($collection, $return = [])
    {
        $return = [];
        foreach ($collection->keys() as $item) {
            $return[] = $item;
            if ($collection->get($item) instanceof Collection) {
                foreach ($this->toList($collection->get($item)) as $subItem) {
                    $return[] = $item.'/'.$subItem;
                }
            }
        }

        return $return;
    }
}
