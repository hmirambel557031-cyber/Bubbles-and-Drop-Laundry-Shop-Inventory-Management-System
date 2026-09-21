<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer.landing');
})->name('customer.landing');

Route::get('/check-laundry', [CustomerController::class, 'showCheckForm'])
    ->name('customer.check-laundry');

Route::post('/check-laundry', [CustomerController::class, 'searchLaundry'])
    ->name('customer.search-laundry');

Route::get('/avail-service', [CustomerController::class, 'showAvailService'])
    ->name('customer.avail-service');

Route::post('/avail-service', [CustomerController::class, 'createOrder'])
    ->name('customer.create-order');
    
    Route::middleware('auth')->group(function () {

    Route::get('/staff/orders', [StaffOrderController::class, 'index'])
        ->name('staff.orders.index');

    Route::get('/staff/orders/{order}/edit', [StaffOrderController::class, 'edit'])
        ->name('staff.orders.edit');

    Route::put('/staff/orders/{order}', [StaffOrderController::class, 'update'])
        ->name('staff.orders.update');

});