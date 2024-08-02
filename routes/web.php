<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/', 'dashboard');
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    Route::view('/transaction/deposit', 'transaksi.deposit')->name('trans_depo');
    Route::view('/transaction/{trx_id}/payment', 'transaksi.payment')->name('trans_payment');



    Route::view('card-check/stripe/gate-1', 'gate1')->name('gate1');




    // ADMIN

    Route::name('admin.')->prefix('admin')->group(function () {
        Route::view('voucher', 'admin-voucher')->name('voucher');
        Route::view('service', 'admin-service')->name('service');
    });



});


require __DIR__.'/auth.php';
