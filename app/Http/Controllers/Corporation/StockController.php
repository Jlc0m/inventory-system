<?php

namespace App\Http\Controllers\Corporation;

use App\Http\Controllers\Controller;
use App\Models\Corporation\Company;
use App\Models\Corporation\Office;
use App\Models\Corporation\Stock;
use App\Models\Location\City;
use App\Models\Location\Country;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Stock $stock)
    {
        $stocks = $stock->paginate(20);
        return view('/admin/corporation/stocks/stocks-index-panel-admin', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Country $country, Company $company, City $city, Office $office)
    {
        $countries = $country->all();
        $companies = $company->all();
        $cities = $city->all();
        $offices = $office->all();

        return view('/admin/corporation/stocks/stocks-create-panel-admin', compact('countries', 'companies', 'cities', 'offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Stock $stock)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'country_id' => 'required|integer|exists:countries,id',
            'company_id' => 'required|integer|exists:companies,id',
            'city_id' => 'required|integer|exists:cities,id',
            'office_id' => 'nullable|integer|exists:offices,id',
            'description' => 'nullable|min:10|max:200',
        ]);
        
        $stock->create($request->all());

        return redirect()->back()->with('status', 'Successful add stock!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock, Country $country, Company $company, City $city, Office $office)
    {
        $countries = $country->all();
        $companies = $company->all();
        $cities = $city->all();
        $offices = $office->all();

        return view('/admin/corporation/stocks/stocks-edit-panel-admin', compact('stock', 'countries', 'companies', 'cities', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'country_id' => 'required|integer|exists:countries,id',
            'company_id' => 'required|integer|exists:companies,id',
            'city_id' => 'required|integer|exists:cities,id',
            'office_id' => 'nullable|integer|exists:offices,id',
            'description' => 'nullable|min:10|max:200',
        ]);
        
        $stock->update($request->all());

        return redirect()->back()->with('status', 'Successful add stock!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
