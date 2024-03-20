<?php

namespace App\Models\Location;

use App\Models\Corporation\Company;
use App\Models\Corporation\Stock;
use App\Models\Inventory\Inventory;
use App\Models\Inventory\Transaction\InventoryReceiveTransaction;
use App\Models\Inventory\Transaction\InventoryRelocateTransaction;
use App\Models\Staff\User;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'name',
        'country_id'
    ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_cities', 'city_id', 'user_id');
    }

    public function companies(){
        return $this->belongsToMany(Company::class, 'company_cities', 'city_id', 'company_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'city_id', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'city_id', 'id');
    }

    public function inventoryRelocateTransactions(): HasMany
    {
        return $this->hasMany(InventoryRelocateTransaction::class, 'city_id', 'id');
    }

    public function inventoryReceiveTransactions(): HasMany
    {
        return $this->hasMany(InventoryReceiveTransaction::class, 'city_id', 'id');
    }

    
}
