<?php

namespace App\Http\Controllers\Inventory\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Invcomment;
use App\Models\Inventory\Transaction\InventoryRelocateTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function updateRelocateTransactions(Request $request, $id)
    {
        $inventoryRelocateTransaction = InventoryRelocateTransaction::find($id);

        $inventoryRelocateTransaction->update([
            'approved' => $request->filled('approved') ? $request->approved : $inventoryRelocateTransaction->approved,
            'status' => $request->filled('status') ? $request->status : $inventoryRelocateTransaction->status,
        ]);

        return redirect()->back()->with('status', 'Вы успешно внесли изменения.');     
    }

    public function updateReceiveTransactions(Request $request)
    {
        //
    }
}
