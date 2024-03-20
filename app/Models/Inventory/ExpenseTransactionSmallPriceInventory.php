<?php

namespace App\Models\Inventory;

use App\Models\Corporation\Office;
use App\Models\Staff\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseTransactionSmallPriceInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'office_id',
        'category_small_price_inventory_id',
        'quantity'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function category_small_price_inventory(): BelongsTo
    {
        return $this->belongsTo(CategorySmallPriceInventory::class);
    }
}
