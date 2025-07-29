<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ReceivedController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\MaintenanceController;

Auth::routes(['register' => false]);

Route::get('/', [FrontendController::class, 'index'])->name('root');


// dashboard routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// management

Route::prefix(env('HOST_NAME'))->middleware(['rolecheck'])->group(function () {
    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    Route::post('/management/user/register', [ManagementController::class, 'store_register'])->name('management.store');
    Route::post('/management/user/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.down');

    //role
    Route::get('/management/role', [ManagementController::class, 'role_index'])->name('management.role.index');
    Route::post('/management/role/assign', [ManagementController::class, 'role_assign'])->name('management.role.assign');
    Route::post('/management/role/undo/blogger/{id}', [ManagementController::class, 'blogger_grade_down'])->name('management.role.blogger.down');
    Route::post('/management/role/undo/user/{id}', [ManagementController::class, 'user_grade_down'])->name('management.role.user.down');
});



// profile

Route::get("/home/profile", [ProfileController::class, 'index'])->name('home.profile');
Route::post("/home/profile/name/update", [ProfileController::class, 'name_update'])->name('home.profile.name.update');
Route::post("/home/profile/password/update", [ProfileController::class, 'password_update'])->name('home.profile.password.update');
Route::post("/home/profile/image/update", [ProfileController::class, 'image_update'])->name('home.profile.image.update');



// brand

Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
Route::post('/brand/update/{slug}', [BrandController::class, 'update'])->name('brand.update');
Route::post('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
Route::post('/brand/status/{slug}', [BrandController::class, 'status'])->name('brand.status');


// category

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{slug}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::post('/category/status/{slug}', [CategoryController::class, 'status'])->name('category.status');


// store

Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
Route::post('/store/store', [StoreController::class, 'store'])->name('store.store');
Route::get('/store/edit/{id}', [StoreController::class, 'edit'])->name('store.edit');
Route::post('/store/update/{slug}', [StoreController::class, 'update'])->name('store.update');
Route::post('/store/delete/{id}', [StoreController::class, 'destroy'])->name('store.destroy');
Route::post('/store/status/{slug}', [StoreController::class, 'status'])->name('store.status');


// item

Route::get('/item', [ItemController::class, 'index'])->name('item.index');
Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
Route::post('/item/store', [ItemController::class, 'store'])->name('item.store');
Route::get('/item/edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
Route::post('/item/update/{slug}', [ItemController::class, 'update'])->name('item.update');
Route::delete('/item/delete/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
Route::post('/item/status/{slug}', [ItemController::class, 'status'])->name('item.status');



// vehicle

Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store');
Route::get('/vehicle/edit/{id}', [VehicleController::class, 'edit'])->name('vehicle.edit');
Route::post('/vehicle/update/{slug}', [VehicleController::class, 'update'])->name('vehicle.update');
Route::post('/vehicle/delete/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');
Route::post('/vehicle/status/{slug}', [VehicleController::class, 'status'])->name('vehicle.status');



// maintenance

Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
Route::post('/maintenance/store', [MaintenanceController::class, 'store'])->name('maintenance.store');
Route::get('/maintenance/edit/{id}', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
Route::post('/maintenance/update/{slug}', [MaintenanceController::class, 'update'])->name('maintenance.update');
Route::post('/maintenance/delete/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');
Route::post('/maintenance/status/{slug}', [MaintenanceController::class, 'status'])->name('maintenance.status');

// maintenance

Route::get('/received', [ReceivedController::class, 'index'])->name('received.index');
Route::get('/received/create', [ReceivedController::class, 'create'])->name('received.create');
Route::post('/received/store', [ReceivedController::class, 'store'])->name('received.store');
Route::get('/received/edit/{id}', [ReceivedController::class, 'edit'])->name('received.edit');
Route::post('/received/update/{slug}', [ReceivedController::class, 'update'])->name('received.update');
Route::post('/received/delete/{id}', [ReceivedController::class, 'destroy'])->name('received.destroy');
Route::post('/received/status/{slug}', [ReceivedController::class, 'status'])->name('received.status');
