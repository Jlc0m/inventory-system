<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'path_file_receipt_accounts',
    ];

    public function receiveTransactions(){
        return $this->hasMany(ReceiveTransactionSmallPriceInventory::class, 'receipt_account_id', 'id');
    }
}
