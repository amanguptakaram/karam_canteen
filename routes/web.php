<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FoodController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminDashboardController;


/*
|--------------------------------------------------------------------------
| Public Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', [FoodController::class, 'home'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| User Authentication
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Cart & User Orders
|--------------------------------------------------------------------------
| Only logged-in users can access these routes.
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

    Route::post('/cart/add/{food}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/update/{food}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/remove/{food}', [CartController::class, 'remove'])
        ->name('cart.remove');

    Route::delete('/cart/clear', [CartController::class, 'clear'])
        ->name('cart.clear');


    /*
    |--------------------------------------------------------------------------
    | User Orders
    |--------------------------------------------------------------------------
    */

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');
});


/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
| These routes must remain outside the admin middleware.
| Otherwise the admin would not be able to open the login page.
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.store');


/*
|--------------------------------------------------------------------------
| Protected Admin Panel
|--------------------------------------------------------------------------
| AdminMiddleware checks:
| 1. User is logged in
| 2. User role is admin
|
| Therefore all admin pages are protected from one place.
*/

Route::middleware('admin')
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Food Management
        |--------------------------------------------------------------------------
        |
        | Route names intentionally remain:
        | foods.index
        | foods.create
        | foods.store
        | foods.show
        | foods.edit
        | foods.update
        | foods.destroy
        |
        | So your existing food Blade files don't need route-name changes.
        |
        */

        Route::resource('foods', FoodController::class);


        /*
        |--------------------------------------------------------------------------
        | Admin Orders
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('admin.orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('admin.orders.show');

        Route::patch('/orders/{order}/accept', [AdminOrderController::class, 'accept'])
            ->name('admin.orders.accept');


        /*
        |--------------------------------------------------------------------------
        | Admin Users
        |--------------------------------------------------------------------------
        */

        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('admin.users.index');

        Route::get('/users/{user}', [AdminUserController::class, 'show'])
            ->name('admin.users.show');


        /*
        |--------------------------------------------------------------------------
        | Admin Logout
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('admin.logout');
    });