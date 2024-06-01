<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthentcationController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\FProductController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroSectionController;

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Front\WishlistController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {

Route::get('/', [HomeController::class, 'index']);

Route::get('/product-details/{product}', [FProductController::class, 'show'])->name('product-details');


// Categories routes
Route::middleware(['auth', 'checkRole:admin,superAdmin'])->group(function () {
    Route::get('categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
    Route::put('categories/{id}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoriesController::class, 'forceDelete'])->name('categories.force-delete');
    Route::resource('categories', CategoriesController::class);
});



Route::get('admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'checkRole:admin,web'])
    ->name('dashboard');


    Route::middleware(['auth', 'checkRole:admin,superAdmin'])->group(function () {
        Route::resource('products', ProductController::class);
    });


    Route::resource('cart', CartController::class);
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');


    Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'store']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/user/2fa', [TwoFactorAuthentcationController::class, 'index'])
->name('front.2fa');


Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])
    ->name('auth.socilaite.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])
    ->name('auth.socilaite.callback');

Route::get('auth/{provider}/user', [SocialController::class, 'index']);



Route::get('orders/{order}/pay', [PaymentsController::class, 'create'])
    ->name('orders.payments.create');

Route::post('orders/{order}/stripe/paymeny-intent', [PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');

Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])
    ->name('stripe.return');


    Route::get('/orders/{order}', [OrdersController::class, 'show'])
    ->name('orders.show');


    Route::get('/products/category/{category_id}', [FProductController::class, 'getProductsByCategory'])->name('products.byCategory');
    Route::get('/search', [FProductController::class, 'searchProducts'])->name('products.search');



    Route::middleware(['auth'])->group(function () {
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
        Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    });

    Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');

// require __DIR__.'/auth.php';
});