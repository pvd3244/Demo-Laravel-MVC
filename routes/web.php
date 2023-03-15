<?php

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
Route::resource('users', UserController::class)->middleware('login')->except(['show']);

Route::get('login', function() {
    return view('user.login');
})->name('user.login');

Route::post('login', [UserController::class, 'login'])->name('users.login');

Route::get('/', function() {
    return redirect(route('user.login'));
});

Route::post('/', [UserController::class, 'logout'])->name('user.logout');

Route::get('user/{id}/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('login');

Route::put('user/{id}/profile', [UserController::class, 'updatePassword'])->name('user.updatePassword');

Route::get('remember', function() {
    return view('user.reset-password');
})->name('user.remember');

Route::post('remember', [UserController::class, 'createToken'])->name('user.createToken');

Route::get('remember/{email}', function() {
    return view('user.reset-token');
})->name('user.token');

Route::post('remember/{email}', [UserController::class, 'resetPassword'])->name('user.confirmToken');
