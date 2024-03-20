<?php

namespace App\Models\Corporation;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCity extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
}
