<?php

namespace App\Models\Location;

use App\Models\Corporation\Company;
use App\Models\Corporation\Stock;
use App\Models\Staff\User;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_countries', 'country_id', 'user_id');
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'country_id', 'id');
    }

}
