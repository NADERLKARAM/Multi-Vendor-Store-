<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\FProductController;
use App\Http\Controllers\Front\CartController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/product-details/{product}', [FProductController::class, 'show'])->name('product-details');


// Categories routes
Route::middleware(['auth', 'checkRole:admin,superAdmin'])->group(function () {
    Route::get('categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
    Route::put('categories/{id}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoriesController::class, 'forceDelete'])->name('categories.force-delete');
    Route::resource('categories', CategoriesController::class);
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'checkRole:admin,superAdmin'])
    ->name('dashboard');


    Route::middleware(['auth', 'checkRole:admin,superAdmin'])->group(function () {
        Route::resource('products', ProductController::class);
    });


    Route::resource('cart', CartController::class);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';