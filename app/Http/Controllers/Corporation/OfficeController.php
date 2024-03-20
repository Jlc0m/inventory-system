<?php

namespace App\Http\Controllers\Corporation;

use App\Http\Controllers\Controller;
use App\Models\Corporation\Company;
use App\Models\Corporation\Office;
use App\Models\Location\City;
use App\Models\Location\Country;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Office $office)
    {

        $offices = $office->orderBy('created_at', 'DESC')->paginate(20);

        return view('/admin/corporation/offices/offices-index-panel-admin', compact('offices'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Country $country, Company $company, City $city)
    {
        $countries = $country->all();
        $companies = $company->all();
        $cities = $city->all();

        return view('/admin/corporation/offices/offices-create-panel-admin', compact('countries', 'companies', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Office $office)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'address' => 'nullable|min:5|max:200',
            'country_id' => 'required|integer|exists:countries,id',
            'company_id' => 'required|integer|exists:companies,id',
            'city_id' => 'required|integer|exists:cities,id',
            'description' => 'nullable|min:10|max:200',
        ]);
        
        $office->create($request->all());

        return redirect()->back()->with('status', 'Successful add office!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office, Country $country, Company $company, City $city)
    {
        $countries = $country->all();
        $companies = $company->all();
        $cities = $city->all();

        return view('/admin/corporation/offices/offices-edit-panel-admin', compact('office', 'companies', 'countries', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'address' => 'nullable|min:5|max:200',
            'country_id' => 'required|integer|exists:countries,id',
            'company_id' => 'required|integer|exists:companies,id',
            'city_id' => 'required|integer|exists:cities,id',
            'description' => 'nullable|min:10|max:200',
        ]);
        
        $office->update($request->all());

        return redirect()->back()->with('status', 'Successful update office!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        //
    }
}
