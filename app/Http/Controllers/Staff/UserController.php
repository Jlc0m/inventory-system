<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Corporation\Company;
use App\Models\Corporation\Office;
use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Staff\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function profile(User $user)
    {
        $auth_user = User::findOrFail(auth()->user()->id);

        if ($user->id == auth()->user()->id || $auth_user->hasRole('SuperAdmin')) {

            $inventoryRelocateTransactions = $user->inventoryRelocateTransactions()->orderBy('created_at', 'DESC')->get();

            $inventoryReceiveTransactions = $user->inventoryReceiveTransactions()->orderBy('created_at', 'DESC')->get();

            return view('user/profile', compact('user', 'inventoryRelocateTransactions', 'inventoryReceiveTransactions'));

        }
            return abort(401);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'DESC')->paginate(10);

        return view('/admin/staff/users/users-index-panel-admin', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/admin/staff/users/users-create-panel-admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->back()->with('status', 'Successful add user!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Country $country, Company $company, City $city, Office $office, Role $role)
    {
        $countries = $country->all();
        $companies = $company->all();
        $cities = $city->all();
        $offices = $office->all();
        $roles = $role->all();

        return view('/admin/staff/users/users-edit-panel-admin', compact('user', 'countries', 'companies', 'cities', 'offices', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Role $role)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|min:3|max:100',
            'country_ids' => 'nullable|array',
            'country_ids.*' => 'nullable|exists:countries,id',
            'company_ids' => 'nullable|array',
            'comapny_ids.*' => 'nullable|exists:companies,id',
            'city_ids' => 'nullable|array',
            'city_ids.*' => 'nullable|exists:cities,id',
            'office_ids' => 'nullable|array',
            'office_ids.*' => 'nullable|exists:offices,id',

            'role_id' => 'nullable|integer|exists:roles,id',
            /////////////
        ]);

        $countryIds = $request['country_ids'];
        unset($request['country_ids']);

        $companyIds = $request['company_ids'];
        unset($request['company_ids']);

        $cityIds = $request['city_ids'];
        unset($request['city_ids']);

        $officeIds = $request['office_ids'];
        unset($request['office_ids']);

        $updateUser = $user->findOrFail($user->id);

        $updateUser->countries()->detach();
        $updateUser->countries()->attach($countryIds);

        $updateUser->companies()->detach();
        $updateUser->companies()->attach($companyIds);

        $updateUser->cities()->detach();
        $updateUser->cities()->attach($cityIds);

        $updateUser->offices()->detach();
        $updateUser->offices()->attach($officeIds);

        $updateUser->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if ($request->role_id != null) {
            $role = $role->find($request->role_id);
        } else {
        }

        if ($role != null) {
            $user->syncRoles([$role->name]);
        } else {
            $user->removeRole($user->roles->first());
        }

        return redirect()->back()->with('status', 'Successful updated user!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
