<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Invcomment;
use App\Models\Inventory\Inventory;
use App\Models\Specification\Category;
use App\Models\Specification\Condition;
use App\Models\Specification\Department;
use App\Models\Staff\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/inventory/my-filters-inventory/my-sity-inventory');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {   
        $user = Auth::user();

        return view('/inventory/resource-inventory/create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInventoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Inventory $inventory, User $user)
    {
        //dd($request);
        
        $request->validate([
            'interior_number' => 'required|unique:inventories|min:3|max:100',
            'name' => 'required|min:3|max:100',
            'invoice' => 'min:3|max:100|nullable',
            'delivery_note' => 'min:3|max:100|nullable',
            'country_id' => 'required|integer|exists:countries,id',
            'company_id' => 'required|integer|exists:companies,id',
            'city_id' => 'required|integer|exists:cities,id',
            'condition_id' => 'required|integer|exists:conditions,id',
            'office_id' => 'required|integer|exists:offices,id',
            ]);
        /* dd($request->all()); */

        $inventory->create($request->all());

        return redirect()->back()->with('status', 'Successful add inventory');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory, Invcomment $invcomment)
    {
        $invcomments = $inventory->invcomments()->orderBy('created_at', 'DESC')->get();

        $user = Auth::user();

        $userCities = $user->cities->keyBy('id');
        $inventoryCity = $inventory->city_id;

        if ($userCities->has($inventoryCity)){
            return view('/inventory/resource-inventory/show', compact('inventory', 'invcomments'));
        }else{
            return abort(401);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory, User $user, Category $category, Condition $condition, Department $department)
    {
        $categories = $category->all();
        $conditions = $condition->all();
        $departments = $department->all();

        $user = Auth::user();

        $userCities = $user->cities->keyBy('id');
        $inventoryCity = $inventory->city_id;

        if ($userCities->has($inventoryCity)){
            return view('/inventory/resource-inventory/edit', compact('inventory', 'user', 'categories', 'conditions', 'departments'));
        }else{
            return abort(401);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInventoryRequest  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'name' => 'min:3|max:100',
            'interior_number' => 'nullable|min:3|max:100',
            'external_number' => 'nullable|min:3|max:100',
            'country_id' => 'integer|exists:countries,id',
            'company_id' => 'integer|exists:companies,id',
            'city_id' => 'integer|exists:cities,id',
            'office_id' => 'nullable|integer|exists:offices,id',
            'stock_id' => 'nullable|integer|exists:stocks,id',
            'condition_id' => 'nullable|integer|exists:conditions,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'department_id' => 'nullable|exists:departments,id',
            'invoice' => 'nullable|min:3|max:100',
            'delivery_note' => 'nullable|min:3|max:100',
            'description' => 'nullable|min:3|max:2000',
            ]);

        $inventory->update($request->all());

        return redirect(session('links')[2])->with('status', 'Successful update inventory');

        /* return redirect()->back()->with('status', 'Successful update inventory'); */


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }

    public function updateLog($id, Inventory $inventory)
    {

        $audits = $inventory->find($id)->audits;
        $inventory = $inventory->find($id);

        return view('/inventory/updateLog/inventory-log-update', compact('audits', 'inventory'));
    }

    public function invcomment(Request $request, Invcomment $invcomment)
    {
        $request ->validate([
            'title' => 'required|min:3|max:2000',
            'user_id' => 'integer|exists:users,id',
            'inventory_id' => 'integer|exists:inventories,id',
        ]);

        $invcomment->create($request->all());

        return redirect()->back()->with('status', 'Successful add comment');
    }
}
