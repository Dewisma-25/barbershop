<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\KasirController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\ServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/admindashboard', function () {
    return view('admin.admindashboard');
})->middleware(['auth']);

Route::get('/user/booking', function () {
    return view('user.booking');
})->middleware('auth')->name('user.booking');


// - - - - CRUD untuk data di table users pada dashboard admin - - - -
Route::middleware(['auth', 'role:admin,kasir'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


//route CRUD customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');

    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');

    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');


    
//route CRUD kasir
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');

    Route::get('/kasir/{id}/edit', [KasirController::class, 'edit'])->name('kasir.edit');

    Route::put('/kasir/{id}', [KasirController::class, 'update'])->name('kasir.update');

    Route::delete('/kasir/{id}', [KasirController::class, 'destroy'])->name('kasir.destroy');



//route CRUD service
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');

    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');

    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');

    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');

    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

});

require __DIR__.'/auth.php';
