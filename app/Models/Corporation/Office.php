<?php

namespace App\Models\Corporation;

use App\Models\Inventory\ExpenseTransactionSmallPriceInventory;
use App\Models\Inventory\Inventory;
use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'name',
        'address',
        'country_id',
        'company_id',
        'city_id',
        'description',
    ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'office_id', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'office_id', 'id');
    }

    public function expense_transaction_small_price_inventories()
    {
        return $this->hasMany(ExpenseTransactionSmallPriceInventory::class);
    }

}
