<?php

namespace App\Http\Controllers\Inventory\Filters\Cities;

use App\Http\Controllers\Controller;
use App\Models\Location\City;
use App\Models\Staff\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitiesFilterConroller extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $cities = $user->cities;
        
        return view('/inventory/my-cities-filter/index-my-cities', compact('cities'));
    }

}
