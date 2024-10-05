<?php

use App\Http\Controllers\ClientsController;
use Illuminate\Support\Facades\Route;

Route::prefix('client')->name('client.')->group(function(){

    Route::middleware(['guest:client','PreventBackHistoryClient'])->group(function(){
        Route::view('/login', 'back.pages.client.auth.login')->name('login');
        Route::post('/login_handler', [ClientsController::class, 'loginHandler'])->name('login_handler');
        Route::view('/forgot-password','back.pages.client.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [ClientsController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}',[ClientsController::class,'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler',[ClientsController::class,'resetPasswordHandler'])->name('reset-password-handler');
        Route::view('/register', 'back.pages.client.auth.register')->name('register');
        Route::get('/payment-methods-guest',[ClientsController::class, 'paymentMethodsGuest'])->name('payment-methods-guest');
        Route::post('/save-client', [ClientsController::class, 'saveClient'])->name('save-client');
    });

    Route::middleware(['auth:client','PreventBackHistoryClient'])->group(function(){
        Route::view('/home', 'back.pages.client.home')->name('home');
        Route::post('/logout_handler', [ClientsController::class, 'logoutHandler'])->name('logout_handler');
        Route::get('/profile',[ClientsController::class, 'profileView'])->name('profile');
        Route::post('/change-profile-picture', [ClientsController::class,'changeProfilePicture'])->name('change-profile-picture');
        Route::get('/payment-methods',[ClientsController::class, 'paymentMethods'])->name('payment-methods');
        //Route::view('/settings', 'back.pages.settings')->name('settings');
        //Route::post('/change-logo',[ClientsController::class,'changeLogo'])->name('change-logo');
        //Route::post('/change-favicon', [ClientsController::class, 'changeFavicon'])->name('change-favicon');
    });
});
