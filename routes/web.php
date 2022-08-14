<?php

use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {

  Route::prefix('admin')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin');

    Route::get('main', [MainController::class, 'index']);

    #menus
    Route::prefix('menus')->group(function () {
      Route::get('add', [MenuController::class, 'create']);
    });
  });
});