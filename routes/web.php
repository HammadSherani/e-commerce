<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductCOntroller;
use App\Http\Middleware\Adminauthenticator;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/admin/login",[AdminLoginController::class, 'index'])->name('admin.login');
Route::post("/admin/login",[AdminLoginController::class, 'authenticator'])->name('admin.authencate');


// Route::get("/admin/dashboard",[AdminLoginController::class, 'authenticator'])->name('admin.dashboard');
// Route::middleware([Adminauthenticator::class])->group(function () {
    
//     Route::get("/admin/dashboard",[HomeController::class, 'authenticator'])->name('admin.dashboard');
// });


Route::middleware([Adminauthenticator::class])->group(function () {  
    Route::get('/admin/dashboard',[AdminLoginController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/subcategory',[AdminLoginController::class, 'subcategory'])->name('admin.subcategory');
    Route::get('/admin/orders',[AdminLoginController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/discounts',[AdminLoginController::class, 'discounts'])->name('admin.discounts');
    Route::get('/admin/users',[AdminLoginController::class, 'users'])->name('admin.users');
    Route::get('/admin/pages',[AdminLoginController::class, 'pages'])->name('admin.pages');
    
    
    //Create category Route
    
    Route::get('admin/category/create',[CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category/create',[CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category',[CategoryController::class, 'index'])->name('admin.category.index');
    Route::delete('/admin/category/{categoty}/delete',[CategoryController::class, 'destroy'])->name('admin.category.destroy');
    
    
    
    
    // Product ROutes
    Route::get('/admin/products',[ProductCOntroller::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create',[ProductCOntroller::class, 'create'])->name('admin.products.create');    
    Route::post('/admin/products/create',[ProductCOntroller::class, 'store'])->name('admin.products.store');    

    //brands
    Route::get('/admin/brands',[BrandsController::class, 'index'])->name('admin.brands');
    
});    

