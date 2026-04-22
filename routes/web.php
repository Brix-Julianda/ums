<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // User links
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/edit/{id}', [UserController::class, 'show'])->name('user.edit');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // Role Links

    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/create-role', [RoleController::class, 'create'])->name('role.create');
    Route::post('/store-role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('role.destroy');

});

Route::post('/login', [UserController::class, 'login'])->name('login.store');
Route::post('/logout', function () {
    Auth::logout();

    return redirect()->route('login');
})->name('logout');
