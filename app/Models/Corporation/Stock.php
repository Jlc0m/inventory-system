<?php

namespace App\Models\Corporation;

use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'name',
        'country_id',
        'company_id',
        'city_id',
        'office_id',
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

    public function office(){
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

}
