<?php

namespace App\Http\Controllers;

use App\Models\Location\City;
use App\Models\Location\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function dynamicInput() {
        $countries = Country::all();

        return view('inventory/smallPriceInventory/CreateSmallPriceInventory', compact('countries'));
    }

    public function dynamicInputDD(Request $request) {

        $arr = [];
        
        for($i = 0; $i < count($request->name); $i++){
            $arr[$i] = ['name' => $request->name[$i], 'quantity' =>  $request->quantity[$i]];
        }

        dd($arr);

        return view('dynamicInput');
    }

    public function index()
    {

        $user = Auth::user();
        $cities = $user->cities;

        /* dd($cities); */

        return view('test', compact('cities'));
    }

    public function city_inv($id, City $city)
    {
        $cityInv = $city->findorFail($id);

        $inventories = $cityInv->inventories;

        return view('test2', compact('inventories'));
    }

    public function ssl1()
    {
        return file_get_contents('E856E206A4DD4499F182B3E357C1EC3C.txt');
    }

    public function ssl2()
    {
        return view('test2', compact('inventories'));
    }

    public function testqr() {

        $user = Auth::user();
        return view('inventory/scanning/scanning-inventory', compact('user'));
    }


}
