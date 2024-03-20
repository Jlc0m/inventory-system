<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\Location\City;
use App\Models\Location\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $countries = Country::all();
        $cities = City::orderBy('name', 'DESC')->paginate(100);
        return view('/admin/location/city/cities-index-panel-admin', compact('cities', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Country $country)
    {   
        $countries = $country->all();
        return view('/admin/location/city/cities-create-panel-admin', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'country_id' => 'nullable|integer|exists:countries,id',
        ]);

        $city->create($request->all());

        return redirect()->back()->with('status', 'Successful add city');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city, Country $country)
    {
        $countries = $country->all();
        return view('/admin/location/city/cities-edit-panel-admin', compact('countries', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'country_id' => 'nullable|integer|exists:countries,id',
        ]);

        $city->update($request->all());

        return redirect()->back()->with('status', 'Successful update city');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
