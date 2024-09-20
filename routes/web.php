<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
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

Route::post('/event/search/', [UserController::class, 'userSearch'])->name('user.search');

Route::get('/event/{id}', [UserController::class, 'userProfile'])->name('user.profile');


Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');

Route::get('/payment/success', function () {
    return view('payment-success');
})->name('payment.success');

Route::get('/payment/failure', function () {
    return view('payment-failure');
})->name('payment.failure');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function (){
        Route::get('/dashboard', [AdminController::class, 'profile'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

        Route::get('/withdraw-requests', [WithdrawController::class, 'adminWithdraw'])->name('admin.withdraw');
        Route::get('/withdraw-details/{id}', [WithdrawController::class, 'adminWithdrawDetails'])->name('admin.withdraw.details');


        // Settings
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings', [AdminController::class, 'settingsSave'])->name('admin.settings.save');


        // Gifts
        Route::get('/gifts', [AdminController::class, 'gifts'])->name('admin.gifts');

        // Events
        Route::get('/events', [AdminController::class, 'events'])->name('admin.events');
        Route::get('/event-details/{id}', [AdminController::class, 'eventDetails'])->name('admin.events.details');
        Route::post('/event-update', [AdminController::class, 'eventUpdate'])->name('admin.event.update');


    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'profile'])->name('dashboard');

    Route::get('/download/qrcode', [UserController::class, 'downloadQRCode'])->name('download.qrcode');
    Route::get('/setting', [UserController::class, 'setting'])->name('setting');
    Route::get('/gifts', [GiftController::class, 'index'])->name('gifts');

    Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw');
    Route::get('/request-withdraw', [WithdrawController::class, 'requestWithdrawPage'])->name('withdraw.request.page');
    Route::post('/request-withdraw', [WithdrawController::class, 'requestWithdraw'])->name('withdraw.request');

    Route::get('/reports', [GiftController::class, 'reports'])->name('reports');

    Route::post('/update/user', [UserController::class, 'updateUser'])->name('update.user');
    Route::post('/update/location', [UserController::class, 'updateLocation'])->name('update.user.location');
    Route::post('/update/payament-details', [UserController::class, 'updatePaymentDetails'])->name('update.payament.user');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
