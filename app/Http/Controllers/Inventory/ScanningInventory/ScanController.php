<?php

namespace App\Http\Controllers\Inventory\ScanningInventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\InventoryRelocated\InventoryReceiveRequest;
use App\Http\Requests\Inventory\InventoryRelocated\InventoryRelocateRequest;
use App\Http\Requests\Inventory\ScanInventoryCreateRequest;
use App\Models\Corporation\Company;
use App\Models\Corporation\Office;
use App\Models\Inventory\Inventory;
use App\Models\Location\City;
use App\Models\Specification\Category;
use App\Models\Staff\User;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    public function scanInventoryView()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('inventory/scanning/scanning-inventory-create', compact('user', 'categories'));
    }

    public function scanInventoryStore(
        ScanInventoryCreateRequest $scanInventoryCreateRequest,
        InventoryService $inventoryService
    )
    {
        $inventoryService->scanInventoryCreate($scanInventoryCreateRequest);

        return redirect()->back()->with('status', `Инвентарь успешно добавлен!`);
    }

    public function scanInventoryRelocateView()
    {
        $user = Auth::user();
        $users = User::all();
        $companies = Company::all();
        $cities = City::all();
        $offices = Office::all();

        return view('inventory/scanning/scanning-inventory-relocate', compact('user', 'cities', 'offices', 'users', 'companies'));
    }

    public function scanInventoryRelocateStore(
        InventoryRelocateRequest $data,
        InventoryService $inventoryService
    )
    {
        $inventoryService->transactionRelocated($data);

        return 0;
    }

    public function scanInventoryReceiveView()
    {
        $user = Auth::user();
        $transactionsReceive = $user->inventoryReceiveTransactions->where('status', false);
        
        return view('/inventory/scanning/scanning-inventory-receive', compact('user', 'transactionsReceive'));
    }

    public function scanInventoryReceiveStore(
        InventoryReceiveRequest $data,
        InventoryService $inventoryService
    )
    {
        $inventoryService->transactionReceive($data);
        
        return 0;
    }
}
