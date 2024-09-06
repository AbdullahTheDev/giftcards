<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
use App\Http\Controllers\VerificationController;

Route::post('/send-verification-code', [VerificationController::class, 'sendVerificationCode'])->name('send.verification.code');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/user/search/', [UserController::class, 'userSearch'])->name('user.search');

Route::get('/user/{id}', [UserController::class, 'userProfile'])->name('user.profile');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'profile'])->name('dashboard');
    Route::get('/setting', [UserController::class, 'setting'])->name('setting');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
