<?php

use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Service\Upload\UploadService;
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
      Route::post('add', [MenuController::class, 'store']);
      Route::get('list', [MenuController::class, 'index']);
      Route::get('edit/{menu}', [MenuController::class, 'show']);
      Route::post('edit/{menu}', [MenuController::class, 'update']);
      Route::delete('destroy', [MenuController::class, 'destroy']);
    });

    //Products
    Route::prefix('products')->group(function(){
      Route::get('add', [ProductController::class, 'create']);
      Route::post('add', [ProductController::class, 'store']);
      Route::get('list', [ProductController::class, 'index']);
    });

    //Upload
    Route::post('upload/service', [UploadService::class, 'store']);
  });
});
