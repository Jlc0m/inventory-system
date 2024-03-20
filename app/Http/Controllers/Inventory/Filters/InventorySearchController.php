<?php

namespace App\Http\Controllers\Inventory\Filters;

use App\Http\Controllers\Controller;
use App\Http\Filters\InventoryFilter;
use App\Models\Inventory\Inventory;
use Illuminate\Http\Request;

class InventorySearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'interior_number' => '',
        ]);

        if ($request->interior_number == null) {
            return abort(404);
        } else {
            $filter = app()->make(InventoryFilter::class, ['queryParams' => array_filter($data)]);

            $inventories = Inventory::filter($filter)->get();

            return view('/inventory/search/search-inventory-interior_number', compact('inventories'));
        }
    }
}
