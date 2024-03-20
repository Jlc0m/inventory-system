<?php

namespace App\Services\Inventory;

use App\Models\Inventory\SmallPriceInventory;
use Illuminate\Support\Facades\DB;

class SmallPriceInventoryService
{
    public function create(array $names, array $quantity, array $category_small_price_inventory_id, array $data): void
    {
        for ($i = 0; $i < count($names); $i++) {

            $smallPriceInventoryId = [];

            $smallPriceInventoryId = SmallPriceInventory::where('office_id', $data['office_id'])
                ->where('category_small_price_inventory_id', $category_small_price_inventory_id[$i])
                ->pluck('id');

            $smallPriceInventoryId = $smallPriceInventoryId->toArray();

            if (array_key_exists(0, $smallPriceInventoryId)) {

                $this->updateSmallPriceInventory(
                    $smallPriceInventoryId[0],
                    $quantity[$i],
                    $data['receive_transaction_small_price_inventory_id']
                );

            } else {

                $smallPriceInventory = SmallPriceInventory::create(
                    [
                        'name' => $names[$i],
                        'quantity' => $quantity[$i],
                        'company_id' => $data['company_id'],
                        'city_id' => $data['city_id'],
                        'office_id' => $data['office_id'],
                        'stock_id' => $data['stock_id'],
                        'receive_transaction_small_price_inventory_id' => $data['receive_transaction_small_price_inventory_id'],
                        'category_small_price_inventory_id' => $category_small_price_inventory_id[$i],
                    ]
                );

                DB::table('receive_transaction_small_price_inventory_small_price_inventories')->insert([
                    'receive_transaction_small_price_inventory_id' => $data['receive_transaction_small_price_inventory_id'],
                    'small_price_inventory_id' => $smallPriceInventory->id
                ]);

            }

        }
    }

    private function updateSmallPriceInventory(
        int $smallPriceInventoryId,
        int $fullQuantity,
        int $receiveTransactionSmallPriceInventoryId
    ): void
    {
        $smallPriceInventory = SmallPriceInventory::findOrFail($smallPriceInventoryId);
        $newQuantity = $smallPriceInventory->quantity + $fullQuantity;
        $smallPriceInventory->update(['quantity' => $newQuantity]);

        DB::table('receive_transaction_small_price_inventory_small_price_inventories')->insert([
            'receive_transaction_small_price_inventory_id' => $receiveTransactionSmallPriceInventoryId,
            'small_price_inventory_id' => $smallPriceInventoryId
        ]);
    }

    public function update(array $category_small_price_inventory_id, array $quantity, int $office_id): string
    {
        for ($i = 0; $i < count($category_small_price_inventory_id); $i++) {

            $smallPriceInventoryId = SmallPriceInventory::where('office_id', $office_id)
                ->where('category_small_price_inventory_id', $category_small_price_inventory_id[$i])
                ->pluck('id');

            $smallPriceInventoryId = $smallPriceInventoryId->toArray();

            $id = $smallPriceInventoryId[0];

            $smallPriceInventory = SmallPriceInventory::findOrFail($id);

            $newQuantity = $smallPriceInventory->quantity - $quantity[$i];

            if ($newQuantity >= 0) {
                $smallPriceInventory->update(['quantity' => $newQuantity]);
            } else {
                return 'false';
            }

        }

        return 'true';
    }

    public function myLeftovers()
    {
        $user = auth()->user();

        foreach ($user->cities as $city) {
            $collections[] = SmallPriceInventory::where('city_id', $city->id)->get();
        }

        $mergedCollection = collect([]);
        $mergedCollection = collect($collections)->reduce(function ($mergedCollection, $collection) {
            return $mergedCollection->merge($collection);
        }, $mergedCollection);

        return $mergedCollection;
    }
}
