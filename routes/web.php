<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/actionLogin', [AuthController::class, 'actionLogin'])->name('actionlogin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/actionRegister', [AuthController::class, 'actionRegister'])->name('actionregister');

Route::middleware('aksesadmin')->group(function () {
    Route::get('/logout', [AuthController::class, 'actionLogout'])->name('actionlogout');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/actionUser', [UserController::class, 'actionUser'])->name('user.actionuser');
    Route::post('/formUser', [UserController::class, 'formUser'])->name('user.formuser');
    Route::post('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('user.deleteuser');

    Route::post('/product-stock', [ProductController::class, 'index'])->name('product.stock');

    Route::get('/SoalNo6', [FunctionController::class, 'SoalNo6'])->name('soalno6');
    Route::get('/SoalNo7', [FunctionController::class, 'SoalNo7'])->name('soalno7');
});
