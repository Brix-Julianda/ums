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
    Route::get('/users-nav', [UserController::class, 'NavBar'])->name('user.nav');

    // Role Links

    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/create-role', [RoleController::class, 'create'])->name('role.create');

});

Route::post('/login', [UserController::class, 'login'])->name('login.store');
Route::post('/logout', function () {
    Auth::logout();

    return redirect()->route('login');
})->name('logout');

// Route::get('/', function () {
//         return inertia('Home');
//     });
