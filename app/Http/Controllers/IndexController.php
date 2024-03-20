<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Inventory;
use App\Models\Specification\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Inventory $inventory, Condition $condition)
    {
        $user = Auth::user();

        $userCities = $user->cities->keyBy('id')->keys()->toArray();

        $inventories = Inventory::orderBy('created_at' , 'DESC')->whereIn('city_id', $userCities)->get();

        

        return view('index', compact('inventories'));

    }
}
