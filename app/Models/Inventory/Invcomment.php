<?php

namespace App\Models\Inventory;

use App\Models\Staff\User;
use App\Models\Inventory\Inventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invcomment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'inventory_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }
}
