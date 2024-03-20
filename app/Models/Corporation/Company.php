<?php

namespace App\Models\Corporation;

use App\Models\Inventory\Transaction\InventoryReceiveTransaction;
use App\Models\Inventory\Transaction\InventoryRelocateTransaction;
use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'name',
        'country_id',
        'address',
        'requisites',
        'accountant',
        'taxation',
        'description',
    ];

    public function cities(){
        return $this->belongsToMany(City::class, 'company_cities', 'company_id', 'city_id');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function inventoryRelocateTransactions(): HasMany
    {
        return $this->hasMany(InventoryRelocateTransaction::class, 'company_id', 'id');
    }

    public function inventoryReceiveTransactions(): HasMany
    {
        return $this->hasMany(InventoryReceiveTransaction::class, 'company_id', 'id');
    }

}
