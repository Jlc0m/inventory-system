<?php

namespace App\Http\Controllers\Inventory\SmallPriceInventory;


use App\Http\Controllers\Controller;
use App\Models\Inventory\CategorySmallPriceInventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategorySmallPriceInventoryController extends Controller
{

    public function index()
    {
        $categorySmallPriceInventories = CategorySmallPriceInventory::all();

        return $categorySmallPriceInventories;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50|unique:category_small_price_inventories,name',
        ]);

        $categorySmallPriceInventory = CategorySmallPriceInventory::create($request->all());

        return $categorySmallPriceInventory;
    }

    public function update(Request $request, CategorySmallPriceInventory $categorySmallPriceInventory)
    {
        $request->validate([
            'name' => 'required|min:3|max:50|unique:category_small_price_inventories,name',
        ]);

        $categorySmallPriceInventory->update($request->all());
    }

    public function destroy(CategorySmallPriceInventory $categorySmallPriceInventory)
    {
        $categorySmallPriceInventory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
