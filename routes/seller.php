<?php

use App\Http\Controllers\SellersController;
use Illuminate\Support\Facades\Route;

Route::prefix('seller')->name('seller.')->group(function(){

    Route::middleware(['guest:seller','PreventBackHistorySeller'])->group(function(){
        Route::view('/login', 'back.pages.seller.auth.login')->name('login');
        Route::post('/login_handler', [SellersController::class, 'loginHandler'])->name('login_handler');
        Route::view('/forgot-password','back.pages.seller.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [SellersController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}',[SellersController::class,'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler',[SellersController::class,'resetPasswordHandler'])->name('reset-password-handler');
        Route::view('/register', 'back.pages.seller.auth.register')->name('register');
        Route::get('/payment-methods-guest',[SellersController::class, 'paymentMethodsGuest'])->name('payment-methods-guest');
        Route::post('/save-seller', [SellersController::class, 'saveSeller'])->name('save-seller');
    });

    Route::middleware(['auth:seller','PreventBackHistorySeller'])->group(function(){
        Route::view('/home', 'back.pages.seller.home')->name('home');
        Route::post('/logout_handler', [SellersController::class, 'logoutHandler'])->name('logout_handler');
        Route::get('/profile',[SellersController::class, 'profileView'])->name('profile');
        Route::post('/change-profile-picture', [SellersController::class,'changeProfilePicture'])->name('change-profile-picture');
        Route::get('/payment-methods',[SellersController::class, 'paymentMethods'])->name('payment-methods');
        //Route::view('/settings', 'back.pages.settings')->name('settings');
        //Route::post('/change-logo',[SellersController::class,'changeLogo'])->name('change-logo');
        //Route::post('/change-favicon', [SellersController::class, 'changeFavicon'])->name('change-favicon');
    });
});
