<?php

namespace App\Http\Controllers\Corporation;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyRequest;
use App\Models\Corporation\Company;
use App\Models\Location\City;
use App\Models\Location\Country;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {   
        $companies = $company->orderBy('name', 'DESC')->paginate(20);
        return view('/admin/corporation/companies/company-index-panel-admin', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Country $country)
    {
        $countries = $country->all();
        return view('/admin/corporation/companies/company-create-panel-admin', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompanyRequest $request, Company $company)
    {
        $company->create($request->all());

        return redirect()->back()->with('status', 'Successful add company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, Country $country, City $city)
    {
        $countries = $country->all();
        $cities = $city->all();

        return view('/admin/corporation/companies/company-edit-panel-admin', compact('company','countries', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'country_id' => 'required|integer|exists:countries,id',
            'address' => 'nullable|min:5|max:100',
            'requisites' => 'nullable|min:5|max:200',
            'accountant' => 'nullable|min:5|max:200',
            'taxation' => 'nullable|min:1|max:100',
            'description' => 'nullable|min:10|max:200',
            'city_ids' => 'nullable|array',
            'city_ids.*' => 'nullable|exists:cities,id',
        ]);

        
        $cityIds = $request['city_ids'];
        //удаление массива городов из реквеста
        unset($request['city_ids']);

        $updateCompany = $company->findOrFail($company->id);

        //удаление старых связей и привязка новых с реквеста
        $updateCompany->cities()->detach();
        $updateCompany->cities()->attach($cityIds);
        
        $updateCompany->update($request->all());

        return redirect()->back()->with('status', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {   
        //удаление свяей
        $company->cities()->detach();
        $company->findOrFail($company->id)->delete();

        return redirect()->back()->with('status', 'Successful delete company!');
    }
}
