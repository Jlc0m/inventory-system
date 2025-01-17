<?php

namespace App\Models\Inventory\Transaction;

use App\Models\Corporation\Company;
use App\Models\Inventory\Inventory;
use App\Models\Location\City;
use App\Models\Staff\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryRelocateTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'company_id',
        'city_id',
        'office_id',
        'status',
        'approved',
        'description',
    ];

    public function inventories(): BelongsToMany
    {
        return $this->belongsToMany(Inventory::class, 'inventory_relocates', 'inventory_relocate_transaction_id', 'inventory_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function inventoryReceiveTransaction(): HasOne
    {
        return $this->hasOne(InventoryReceiveTransaction::class);
    }
}
