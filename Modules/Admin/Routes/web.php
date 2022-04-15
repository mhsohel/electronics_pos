<?php

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

Route::middleware(['check_admin'])->prefix('admin')->group(function () {
    Route::resource('dealer', DealerController::class);
    Route::resource('showroom', ShowroomController::class);
    Route::resource('purchase', PurchaseController::class);
    Route::resource('product', ProductsController::class);
    Route::resource('product', ProductsController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('size', SizeController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('brand', BrandsController::class);
    Route::resource('color', ColorController::class);
    Route::resource('category', CategoryController::class);
    Route::post('/product_by_barcode', 'PurchaseController@product_by_barcode')->name('product_by_barcode');
    Route::get('/dashboard', 'AdminController@index');
    Route::put('/grn_update/{id}', 'PurchaseController@grn_update')->name('grn_update');
    Route::get('/grn/{id}', 'PurchaseController@grn')->name('grn');
    Route::get('/grn_view/{id}', 'PurchaseController@grn_view')->name('grn_view');
    Route::get('/purchase_list', 'PurchaseController@purchase_list');
    Route::get('/purchase_order', 'PurchaseController@purchase_order')->name('purchase_order');
    Route::get('/getCategory/{id}', 'BrandsController@getCategory');
    Route::get('/', 'AdminController@index')->name('admin');
    //sales routing
    Route::prefix('sales')->group(function(){
        Route::get('/sales-product', 'SalesController@create')->name('sales.create');
        Route::post('/post-product', 'SalesController@store')->name('sales.store');
        Route::get('/sales-list', 'SalesController@show')->name('sales.show');
        // ajax routing for purches information
        Route::get('getPurchasesInfo/{id}', 'SalesController@getPurchaseInfo');
        //getMrp information
        Route::get('getMrp/{productId}/{batchId}', 'SalesController@getMrp');
    });
});
