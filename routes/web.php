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
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminPermissionController;

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
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->middleware('permission:dashboard.view')
            ->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Foods
        |--------------------------------------------------------------------------
        */

        Route::get('/foods', [FoodController::class, 'index'])
            ->middleware('permission:foods.view')
            ->name('foods.index');

        Route::get('/foods/create', [FoodController::class, 'create'])
            ->middleware('permission:foods.create')
            ->name('foods.create');

        Route::post('/foods', [FoodController::class, 'store'])
            ->middleware('permission:foods.create')
            ->name('foods.store');

        Route::get('/foods/{food}', [FoodController::class, 'show'])
            ->middleware('permission:foods.view')
            ->name('foods.show');

        Route::get('/foods/{food}/edit', [FoodController::class, 'edit'])
            ->middleware('permission:foods.edit')
            ->name('foods.edit');

        Route::put('/foods/{food}', [FoodController::class, 'update'])
            ->middleware('permission:foods.edit')
            ->name('foods.update');

        Route::delete('/foods/{food}', [FoodController::class, 'destroy'])
            ->middleware('permission:foods.delete')
            ->name('foods.destroy');


        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->middleware('permission:orders.view')
            ->name('admin.orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->middleware('permission:orders.view')
            ->name('admin.orders.show');

        Route::patch('/orders/{order}/accept', [AdminOrderController::class, 'accept'])
            ->middleware('permission:orders.accept')
            ->name('admin.orders.accept');


        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        Route::get('/users', [AdminUserController::class, 'index'])
            ->middleware('permission:users.view')
            ->name('admin.users.index');

        Route::get('/users/create', [AdminUserController::class, 'create'])
            ->middleware('permission:users.create')
            ->name('admin.users.create');

        Route::post('/users', [AdminUserController::class, 'store'])
            ->middleware('permission:users.create')
            ->name('admin.users.store');

        Route::get('/users/{user}', [AdminUserController::class, 'show'])
            ->middleware('permission:users.view')
            ->name('admin.users.show');

        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])
            ->middleware('permission:users.edit')
            ->name('admin.users.edit');

        Route::put('/users/{user}', [AdminUserController::class, 'update'])
            ->middleware('permission:users.edit')
            ->name('admin.users.update');

        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->middleware('permission:users.delete')
            ->name('admin.users.destroy');


        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        Route::get('/roles', [AdminRoleController::class, 'index'])
            ->middleware('permission:roles.view')
            ->name('roles.index');

        Route::get('/roles/create', [AdminRoleController::class, 'create'])
            ->middleware('permission:roles.create')
            ->name('roles.create');

        Route::post('/roles', [AdminRoleController::class, 'store'])
            ->middleware('permission:roles.create')
            ->name('roles.store');

        Route::get('/roles/{role}/edit', [AdminRoleController::class, 'edit'])
            ->middleware('permission:roles.edit')
            ->name('roles.edit');

        Route::put('/roles/{role}', [AdminRoleController::class, 'update'])
            ->middleware('permission:roles.edit')
            ->name('roles.update');

        Route::delete('/roles/{role}', [AdminRoleController::class, 'destroy'])
            ->middleware('permission:roles.delete')
            ->name('roles.destroy');


        /*
        |--------------------------------------------------------------------------
        | Role Permissions
        |--------------------------------------------------------------------------
        */

        Route::get('/roles/{role}/permissions', [AdminRoleController::class, 'managePermissions'])
            ->middleware('permission:roles.edit')
            ->name('roles.permissions.edit');

        Route::put('/roles/{role}/permissions', [AdminRoleController::class, 'updatePermissions'])
            ->middleware('permission:roles.edit')
            ->name('roles.permissions.update');


        /*
        |--------------------------------------------------------------------------
        | Permissions Catalogue
        |--------------------------------------------------------------------------
        */

        Route::get('/permissions', [AdminPermissionController::class, 'index'])
            ->middleware('permission:permissions.view')
            ->name('permissions.index');


        /*
        |--------------------------------------------------------------------------
        | Admin Logout
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('admin.logout');
    });