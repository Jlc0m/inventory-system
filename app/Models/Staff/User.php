<?php

namespace App\Models\Staff;

use App\Models\Corporation\Company;
use App\Models\Corporation\Office;
use App\Models\Inventory\ExpenseTransactionSmallPriceInventory;
use App\Models\Inventory\Transaction\InventoryReceiveTransaction;
use App\Models\Inventory\Transaction\InventoryRelocateTransaction;
use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Traits\Filterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    use Filterable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'user_countries', 'user_id', 'country_id');
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'user_companies', 'user_id', 'company_id');
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'user_cities', 'user_id', 'city_id');
    }

    public function offices(): BelongsToMany
    {
        return $this->belongsToMany(Office::class, 'user_offices', 'user_id', 'office_id');
    }

    public function expense_transaction_small_price_inventories(): HasMany
    {
        return $this->hasMany(ExpenseTransactionSmallPriceInventory::class);
    }

    public function inventoryRelocateTransactions(): HasMany
    {
        return $this->hasMany(InventoryRelocateTransaction::class, 'user_id', 'id');
    }

    public function inventoryReceiveTransactions(): HasMany
    {
        return $this->hasMany(InventoryReceiveTransaction::class, 'user_id', 'id');
    }
}
