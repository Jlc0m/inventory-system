<?php

namespace App\Models\Inventory;

use App\Models\Corporation\Company;
use App\Models\Corporation\Office;
use App\Models\Corporation\Stock;
use App\Models\Location\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveTransactionSmallPriceInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'city_id',
        'office_id',
        'stock_id',
        'receipt_account_id',
    ];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function office(){
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function stock(){
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    /* public function smallPriceInventory()
    {
        return $this->hasMany(SmallPriceInventory::class, 'receive_transaction_small_price_inventory_id', 'id');
    } */

    public function receiptAccount(){
        return $this->belongsTo(ReceiptAccount::class, 'receipt_account_id', 'id');
    }

    public function smallPriceInventories(){
        return $this->belongsToMany(SmallPriceInventory::class, 'receive_transaction_small_price_inventory_small_price_inventories', 'receive_transaction_small_price_inventory_id', 'small_price_inventory_id');
    }
}
