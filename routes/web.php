<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FourniseurController;
use App\Http\Controllers\PredomController;
use App\Http\Controllers\OrderimportationController;
use App\Http\Controllers\PredomdetailController;
use App\Http\Controllers\OrderLineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImportationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ✅ Public routes
Route::get('/', function () {
    return view('welcome');
});

// ✅ Dashboard (auth + verified)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Authenticated user routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Common routes for all authenticated users
    Route::resource('clients', ClientController::class);
    Route::resource('fourniseurs', FourniseurController::class);
    Route::resource('predoms', PredomController::class);
    Route::resource('orderimportations', OrderimportationController::class);
    // Route::resource('predom_details', PredomdetailController::class);
    Route::get('/predom_details/{predom_id}', [PredomdetailController::class, 'index'])->name('predom_details.index');
    Route::post('/predomdetails/{id}/update-field', [PredomdetailController::class, 'updateField'])->name('predomdetails.updateField');
    Route::post('/predomdetails/{id}/delete-field', [PredomdetailController::class, 'deleteField'])->name('predomdetails.deleteField');



});

// ✅ Role-based routes

// Admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// Commercial + Admin
Route::middleware(['auth', 'role:admin,commercial'])->group(function () {
    Route::resource('orders', OrderController::class);
    Route::resource('order_lines', OrderLineController::class);
});
// appro + Admin
Route::middleware(['auth', 'role:admin,appro'])->group(function () {
    Route::resource('importations', ImportationController::class);
});

// Warehouse + Admin
Route::middleware(['auth', 'role:admin,commercial'])->group(function () {
    Route::resource('products', ProductController::class);
});
// appro + Admin
// Route::middleware(['auth', 'role:admin,appro'])->group(function () {
//     Route::resource('fourniseurs', FourniseurController::class);
// });

Route::get('/fournisseurs/search', [FourniseurController::class, 'search']);

require __DIR__.'/auth.php';
