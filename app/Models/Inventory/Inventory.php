<?php

namespace App\Models\Inventory;

use App\Models\Corporation\Company;
use App\Models\Corporation\Office;
use App\Models\Corporation\Stock;
use App\Models\Inventory\Transaction\InventoryReceiveTransaction;
use App\Models\Inventory\Transaction\InventoryRelocateTransaction;
use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Specification\Category;
use App\Models\Specification\Condition;
use App\Models\Specification\Department;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Inventory extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'interior_number',
        'external_number',
        'country_id',
        'company_id',
        'city_id',
        'office_id',
        'stock_id',
        'employee_id',
        'condition_id',
        'category_id',
        'department_id',
        'invoice',
        'delivery_note',
        'description',
        'user_id',
        'inventory_number_to_itams'
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

    public function office(){
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function stock(){
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    public function condition(){
        return $this->belongsTo(Condition::class, 'condition_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function invcomments()
    {
        return $this->hasMany(Invcomment::class, 'inventory_id', 'id');
    }

    public function inventoryRelocateTransactions(): BelongsToMany
    {
        return $this->belongsToMany(InventoryRelocateTransaction::class, 'inventory_relocates', 'inventory_id', 'inventory_relocate_transaction_id');
    }

    public function inventoryReceiveTransactions(): BelongsToMany
    {
        return $this->belongsToMany(InventoryReceiveTransaction::class, 'inventory_receives', 'inventory_id', 'inventory_receive_transaction_id');
    }

}
