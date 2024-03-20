<?php

namespace App\Models\Specification;

use App\Models\Inventory\Inventory;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'name'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'condition_id', 'id');
    }
}
