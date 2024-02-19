<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

// Brand routes --------------------------------
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
Route::delete('/brands/delete/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

// Api routes --------------------------------
Route::get('/brandsApi', [BrandController::class, 'indexApi']);
Route::post('/storeBrand', [BrandController::class, 'storeApi']);
Route::put('/EditBrand', [BrandController::class, 'updateApi']);
Route::delete('/DeleteBrand', [BrandController::class, 'destroyApi']);

// Product routes --------------------------------
Route::get('/Products/{brand}', [ProductController::class, 'index'])->name('products.index');
Route::get('/Product/{brand}/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/Product', [ProductController::class, 'store'])->name('product.store');
Route::get('/Product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/Product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/Product/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

// Api routes --------------------------------
Route::get('/productsApi', [ProductController::class, 'indexApi']);
Route::post('/storeProduct', [ProductController::class, 'storeApi']);
Route::put('/EditProduct', [ProductController::class, 'updateApi']);
Route::delete('/DeleteProduct', [ProductController::class, 'destroyApi']);
