<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\POSController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// 2. Grup Route yang Mengharuskan Login (Auth)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [POSController::class, 'index'])->name('dashboard');
    
    // Route CRUD Tambahan
    Route::post('/product/store', [POSController::class, 'storeProduct'])->name('product.store');
    Route::delete('/product/{product}', [POSController::class, 'deleteProduct'])->name('product.delete');
    
    Route::post('/customer/store', [POSController::class, 'storeCustomer'])->name('customer.store');
    Route::delete('/customer/{customer}', [POSController::class, 'deleteCustomer'])->name('customer.delete');
    
    Route::post('/pos/store', [POSController::class, 'storeSale'])->name('pos.store');

    // Manajemen Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Route Otentikasi (Login, Register, Logout dari Breeze)
require __DIR__.'/auth.php';