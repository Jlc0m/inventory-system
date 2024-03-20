<?php

namespace App\Services\Inventory;

use App\Models\Inventory\Inventory;
use App\Models\Inventory\Transaction\InventoryReceiveTransaction;
use App\Models\Inventory\Transaction\InventoryRelocateTransaction;
use Illuminate\Support\Facades\Auth;

class InventoryService
{

    public function inventoryCreate()
    {
    }

    public function inventoryUpdate()
    {
    }

    public function inventoryDesroy()
    {
    }

    public function search($data)
    {
        // test function not work!
        $inventories = [];

        foreach(Auth::user()->cities as $city) {
            foreach($city->inventories as $inventory) {
                $inventories[] = $inventory->where('inventory_number', 'like', "%$data%")
                ->orWhere('name', 'like', "%$data%")
                ->get();
            }
        }

        dd($inventories);

        return $inventories;
    }

    public function scanSearch()
    {
    }

    public function scanInventoryCreate($scanInventoryCreateRequest)
    {
        $inventory_number_to_itams = $scanInventoryCreateRequest->inventory_number_to_itams;
        $category_id = $scanInventoryCreateRequest->category_id;

        $callback = function ($value) {
            return (int) $value;
        };

        $category_id = array_map($callback, $category_id);

        $inventories = [];

        $user = Auth::user();

        foreach ($inventory_number_to_itams as $index => $inventory_number) {
            $inventories[] = Inventory::create([
                'inventory_number_to_itams' => $inventory_number,
                'category_id' => $category_id[$index],
                'company_id' => $scanInventoryCreateRequest->company_id,
                'city_id' => $scanInventoryCreateRequest->city_id,
                'office_id' => $scanInventoryCreateRequest->office_id,
                'office_id' => $scanInventoryCreateRequest->office_id,
                'stock_id' => $scanInventoryCreateRequest->stock_id,
                'user_id' => $user->id,
            ]);
        }
        return $inventories;
    }

    public function transactionRelocated($data)
    {
        $inventory_numbers = $data->inventory_number_to_itams;
        $inventories = Inventory::whereIn('inventory_number_to_itams', $inventory_numbers)->get();

        $sender_user_id = Auth::user()->id;

        $inventoryTransactionRelocate = InventoryRelocateTransaction::create([
            'user_id' => $sender_user_id,
            'company_id' => $data->sender_company_id,
            'city_id' => $data->sender_city_id,
            'office_id' => $data->sender_office_id,
            'description' => $data->description
        ]);

        $inventoryTransactionRelocate->inventories()->attach($inventories);

        $inventoryTransactionRecive = InventoryReceiveTransaction::create([
            'user_id' => $data->recipient_user_id,
            'company_id' => $data->recipient_company_id,
            'city_id' => $data->recipient_city_id,
            'office_id' => $data->recipient_office_id,
            'inventory_relocate_transaction_id' => $inventoryTransactionRelocate->id
        ]);

        $inventoryTransactionRecive->inventories()->attach($inventories);

        return 0;
    }

    public function transactionReceive($data)
    {
        $inventory_numbers = $data->inventory_number_to_itams;
        $inventories = Inventory::whereIn('inventory_number_to_itams', $inventory_numbers)->get();

        $receiveTransaction = InventoryReceiveTransaction::find($data->receive_transaction_id);

        $inv = [];

        foreach ($inventories as $inventory) {
            $inv[] = $inventory->update([
                'city_id' => $data->recipient_city_id,
                'office_id' => $data->recipient_office_id,
                'stock_id' => $data->recipient_stock_id
            ]);
        }

        $receiveTransaction->update([
            'status' => true
        ]);

        return $inv;
    }
}
