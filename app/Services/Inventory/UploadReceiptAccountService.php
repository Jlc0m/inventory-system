<?php

namespace App\Services\Inventory;

use App\Models\Inventory\ReceiptAccount;

class UploadReceiptAccountService
{
    public function run($file): int
    {
        $path = $file->store('documents/receiptAccount');

        $receiptAccount = ReceiptAccount::create(['path_file_receipt_accounts' => $path]);

        return $receiptAccount->id;
    }
}
