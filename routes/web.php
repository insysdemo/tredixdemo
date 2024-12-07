<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect()->route('login');
});
Route::view('/login', 'auth.login');

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'checkLogin'])->name('admin.login');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');



    Route::middleware(['auth:web'])->group(function () {

        Route::post('/common/get_delete_modal', [CommonController::class, 'getDeleteModal']);
        Route::post('/common/get_mul_delete_modal', [CommonController::class, 'getMulDeleteModal']);

        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('customer/list', [CustomerController::class, 'list'])->name('admin.customer.list');
        Route::resource('customer', CustomerController::class);

        Route::resource('products', ProductController::class);
        Route::post('products/list', [ProductController::class, 'list'])->name('admin.users.list');
        Route::get('products/send-email/{customer_id}', [ProductController::class, 'sendEmail'])->name('products.sendEmail');


    });
});
