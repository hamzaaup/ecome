<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\FrontendController;

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

Route::get('/', [FrontendController::class, 'index'])->name('home-page');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth','isAdmin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Category
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('add-category', [CategoryController::class, 'add'])->name('add-category');
    Route::post('store-category', [CategoryController::class, 'store'])->name('store-category');
    Route::post('update-category', [CategoryController::class, 'update'])->name('update-category');
    Route::delete('delete-category/{id}', [CategoryController::class, 'delete'])->name('delete-category');

    // Products
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('add-product', [ProductController::class, 'create'])->name('add-product');
    Route::post('store-product', [ProductController::class, 'store'])->name('store-product');
    Route::post('update-product', [ProductController::class, 'update'])->name('update-product');
    Route::delete('delete-product/{id}', [ProductController::class, 'destroy'])->name('delete-product');
});