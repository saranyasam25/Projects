<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CarDetailsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest');
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/', [LoginController::class, 'login']);
Route::post('/forgot-password', [LoginController::class, 'forgotPassword']);
Route::get('/userlogout', [LoginController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'store']);

Route::view('/dashboard','dashboard')->middleware('auth');

Route::view('/car-form','car_form')->middleware('auth');

Route::view('/car-view','car_view')->middleware('auth');

Route::get('/car-view/{id}', [CarDetailsController::class, 'show'])->middleware('auth');

Route::view('/car-edit','edit_form')->middleware('auth');

Route::get('/car-edit/{id}', [CarDetailsController::class, 'editForm'])->middleware('auth');

Route::post('/car-edit-form/{id}', [CarDetailsController::class, 'edit'])->middleware('auth');

Route::post('/car-form', [CarDetailsController::class, 'store'])->middleware('auth');

Route::get('/dashboard', [CarDetailsController::class, 'index'])->middleware('auth');

Route::get('/car-delete', [CarDetailsController::class, 'destroy'])->middleware('auth');

