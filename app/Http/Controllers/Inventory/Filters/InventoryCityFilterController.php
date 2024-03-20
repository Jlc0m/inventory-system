<?php

namespace App\Http\Controllers\Inventory\Filters;

use App\Http\Controllers\Controller;
use App\Models\Location\City;

class InventoryCityFilterController extends Controller
{
    public function __invoke($id, $name, City $city)
    {

        $cityInv = $city->findOrFail($id)->where('name', $name)->firstOrFail();

        $inventories = $cityInv->inventories;

        return view('/inventory/my-filters-inventory/my-sity-inventory', compact('inventories', 'cityInv'));
    }
    
}
