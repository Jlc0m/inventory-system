<?php

namespace App\Http\Controllers\Inventory\SmallPriceInventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmallPriceInventoryRequest;

use App\Models\Inventory\SmallPriceInventory;

use App\Http\Requests\CreateSmallPriceInventoryRequest;
use App\Http\Requests\UpdateSmallPriceInventoryRequest;
use App\Models\Inventory\CategorySmallPriceInventory;

use App\Services\Inventory\SmallPriceInventoryService;
use App\Services\Inventory\TransactionSmallPriceInventoryService;
use App\Services\Inventory\UploadReceiptAccountService;
use Illuminate\Http\Request;

class SmallPriceInventoryController extends Controller
{
    public function index(SmallPriceInventoryRequest $request)
    {
        $smallPriceInventoryQuery = SmallPriceInventory::query();

        if ($request->has('city_id')) {
            $smallPriceInventoryQuery->whereCityId($request->city_id);
        }

        if ($request->has('company_id')) {
            $smallPriceInventoryQuery->whereCompanyId($request->company_id);
        }

        if ($request->has('office_id')) {
            $smallPriceInventoryQuery->whereOfficeId($request->office_id);
        }

        if($request->has('category_small_price_inventory_id')){
            $smallPriceInventoryQuery->whereCategorySmallPriceInventoryId($request->category_small_price_inventory_id);
        }

        return view('', ); $smallPriceInventoryQuery->paginate(30);
    }

    public function show(SmallPriceInventory $smallPriceInventory) {
        return view('inventory/smallPriceInventory/ShowSmallPriceInventory', compact('smallPriceInventory'));
    }

    public function create() {
        $user = auth()->user();
        $categories = CategorySmallPriceInventory::all();
        return view('/inventory/smallPriceInventory/CreateSmallPriceInventory', compact('user', 'categories'));
    }

    public function store(
        CreateSmallPriceInventoryRequest      $request,
        UploadReceiptAccountService           $uploadReceiptAccountService,
        TransactionSmallPriceInventoryService $transactionSmallPriceInventoryService,
        SmallPriceInventoryService            $smallPriceInventoryService,
    )
    {
        $receiptAccountId = $uploadReceiptAccountService->run($request->file);

        $transactionId = $transactionSmallPriceInventoryService->create([
            'user_id' => auth()->user()->id,
            'company_id' => $request->company_id,
            'city_id' => $request->city_id,
            'office_id' => $request->office_id,
            'stock_id' => $request->stock_id,
            'receipt_account_id' => $receiptAccountId,
        ]);

        $smallPriceInventoryService->create(
            (array)$request->name,
            (array)$request->quantity,
            (array)$request->category_small_price_inventory_id,
            [
                'company_id' => $request->company_id,
                'city_id' => $request->city_id,
                'office_id' => $request->office_id,
                'stock_id' => $request->stock_id,
                'receive_transaction_small_price_inventory_id' => $transactionId,
            ]
        );

        return redirect()->back()->with('status', 'Инвентарь успешно добавлен!');
    }

    public function extraditionView() {

        $user = auth()->user();
        $categories = CategorySmallPriceInventory::all();

        return view('/inventory/smallPriceInventory/ExtraditionSmallPriceInventory', compact('user', 'categories'));
    }

    public function extradition(
        UpdateSmallPriceInventoryRequest      $request,
        TransactionSmallPriceInventoryService $transactionSmallPriceInventoryService,
        SmallPriceInventoryService            $smallPriceInventoryService,
    ): string
    {
        $message = $smallPriceInventoryService->update(
            $request->category_small_price_inventory_id,
            $request->quantity,
            $request->office_id
        );


        if ($message === 'true') {
            $transactionSmallPriceInventoryService->update(
                $request->category_small_price_inventory_id,
                $request->quantity,
                [
                    'user_id' => auth()->user()->id,
                    'office_id' => $request->office_id,
                ]
            );
        } else {
            return redirect()->back()->with('status', 'Не хватает на складе!');
        }

        return redirect()->back()->with('status', 'Успешно!');

    }

    public function destroy()
    {

    }

    public function myLeftovers(
        SmallPriceInventoryService $smallPriceInventoryService
    ) {
        $smallPriceInventories = $smallPriceInventoryService->myLeftovers();

        return view('inventory/smallPriceInventory/MySmallPriceInventory', compact('smallPriceInventories'));
    }

}
