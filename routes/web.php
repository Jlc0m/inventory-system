<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Corporation\CompanyController;
use App\Http\Controllers\Corporation\OfficeController;
use App\Http\Controllers\Corporation\StockController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Inventory\Filters\Cities\CitiesFilterConroller;
use App\Http\Controllers\Inventory\Filters\InventoryCityFilterController;
use App\Http\Controllers\Inventory\Filters\InventorySearchController;
use App\Http\Controllers\Inventory\InventoryController;
use App\Http\Controllers\Inventory\ScanningInventory\ScanController;
use App\Http\Controllers\Inventory\SmallPriceInventory\CategorySmallPriceInventoryController;
use App\Http\Controllers\Inventory\SmallPriceInventory\SmallPriceInventoryController;
use App\Http\Controllers\Inventory\Transaction\TransactionController;
use App\Http\Controllers\Location\CityController;
use App\Http\Controllers\Location\CountryController;
use App\Http\Controllers\Specification\CategoryController;
use App\Http\Controllers\Specification\ConditionController;
use App\Http\Controllers\Specification\DepartmentController;
use App\Http\Controllers\Staff\PermissionController;
use App\Http\Controllers\Staff\RoleController;
use App\Http\Controllers\Staff\UserController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/search-inventory', InventorySearchController::class)->name('interior_number');

Route::prefix('inventory')->middleware('auth')->group(function () {
    Route::get('/inventories/updateLog/{id}/{interior_number}', [InventoryController::class, 'updateLog'])->name('updateLog');
    Route::post('/inventories/invcomment', [InventoryController::class, 'invcomment'])->name('invcomment_add');
    Route::resource('inventories', InventoryController::class);
    Route::get('/my-sities', CitiesFilterConroller::class)->name('my-cities');
    Route::get('/my-sities-filter/{id}/{name}', InventoryCityFilterController::class)->name('my-cities-filter');

    Route::get('/small-price-inventory/myLeftovers', [SmallPriceInventoryController::class, 'myLeftovers'])->name('myLeftovers');
    Route::get('/small-price-inventory/extradition', [SmallPriceInventoryController::class, 'extraditionView'])->name('view-extradition');
    Route::post('/small-price-inventory/extradition', [SmallPriceInventoryController::class, 'extradition'])->name('extradition');
    Route::resource('small-price-inventory', SmallPriceInventoryController::class);
});

//Все что касается сканирования инвентаря\\
Route::prefix('scanning')->middleware('auth')->group(function () {
    Route::get('scan-inventories', [ScanController::class, 'scanInventoryView'])->name('scan-inventory');
    Route::post('scan-inventories-post', [ScanController::class, 'scanInventoryStore'])->name('scan-inventory-post');
    Route::get('scan-inventories-relocate', [ScanController::class, 'scanInventoryRelocateView'])->name('scan-inventories-relocate');
    Route::post('scan-inventories-relocate-post', [ScanController::class, 'scanInventoryRelocateStore'])->name('scan-inventories-relocate-post');
    Route::get('scan-inventories-receive', [ScanController::class, 'scanInventoryReceiveView'])->name('scan-inventories-receive');
    Route::post('scan-inventories-receive-post', [ScanController::class, 'scanInventoryReceiveStore'])->name('scan-inventories-receive-post');
    Route::get('search', [ScanController::class, 'search'])->name('scan-search');
});

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('user/{user}', [UserController::class, 'profile'])->name('profile');
});

Route::prefix('Transaction')->middleware('auth')->group(function () {
    Route::post('approved/{id}', [TransactionController::class, 'updateRelocateTransactions'])->name('approved-transaction');
});

//Все что касается админки создания/удаления прав, пользователей и т.д\\
Route::prefix('admin')->middleware('auth', 'can:SuperAdmin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('cities', CityController::class);
    Route::resource('offices', OfficeController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('conditions', ConditionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

Route::get('/', [IndexController::class, 'index'])->middleware('auth')->name('home');


Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');


/* Route::resource('small-price-inventory', SmallPriceInventoryController::class);
Route::post('/update', [SmallPriceInventoryController::class, 'update']); */

