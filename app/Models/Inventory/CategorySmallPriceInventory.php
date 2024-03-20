<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategorySmallPriceInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function expense_transaction_small_price_inventories(): HasMany
    {
        return $this->hasMany(ExpenseTransactionSmallPriceInventory::class);
    }

    public function smallPriceInventory(): HasMany
    {
        return $this->hasMany(SmallPriceInventory::class);
    }
}
