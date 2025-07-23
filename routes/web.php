<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ManagementController;

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


// category

Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
Route::post('/store/store', [StoreController::class, 'store'])->name('store.store');
Route::get('/store/edit/{id}', [StoreController::class, 'edit'])->name('store.edit');
Route::post('/store/update/{slug}', [StoreController::class, 'update'])->name('store.update');
Route::post('/store/delete/{id}', [StoreController::class, 'destroy'])->name('store.destroy');
Route::post('/store/status/{slug}', [StoreController::class, 'status'])->name('store.status');
