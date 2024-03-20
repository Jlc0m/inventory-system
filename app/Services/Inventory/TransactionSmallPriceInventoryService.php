<?php

namespace App\Services\Inventory;

use App\Models\Inventory\ExpenseTransactionSmallPriceInventory;
use App\Models\Inventory\ReceiveTransactionSmallPriceInventory;

class TransactionSmallPriceInventoryService
{

    public function create(array $data): int
    {
        $transaction = ReceiveTransactionSmallPriceInventory::create($data);

        return $transaction->id;
    }

    public function update(array $category_small_price_inventory_id, array $quantity, array $data): void
    {
        for ($i = 0; $i < count($category_small_price_inventory_id); $i++) {
            ExpenseTransactionSmallPriceInventory::create([
                'category_small_price_inventory_id' => $category_small_price_inventory_id[$i],
                'quantity' => $quantity[$i],
                'office_id' => $data['office_id'],
                'user_id' => $data['user_id'],
            ]);
        }
    }

}
