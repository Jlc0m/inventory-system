<?php

namespace App\Models\Inventory;

use App\Builders\SmallPriceInventoryBuilder;
use App\Models\Corporation\Company;
use App\Models\Corporation\Office;
use App\Models\Corporation\Stock;
use App\Models\Location\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmallPriceInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'company_id',
        'city_id',
        'office_id',
        'stock_id' ,
        'receive_transaction_small_price_inventory_id',
        'category_small_price_inventory_id',
    ];


    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    /* public function receiveTransactionSmallPriceInventory(): BelongsTo
    {
        return $this->belongsTo(ReceiveTransactionSmallPriceInventory::class, 'receive_transaction_small_price_inventory_id', 'id');
    } */

    public function category() {
        return $this->belongsTo(CategorySmallPriceInventory::class, 'category_small_price_inventory_id', 'id');
    }

    public function receiveTransactions(){
        return $this->belongsToMany(ReceiveTransactionSmallPriceInventory::class, 'receive_transaction_small_price_inventory_small_price_inventories', 'small_price_inventory_id', 'receive_transaction_small_price_inventory_id');
    }

}
