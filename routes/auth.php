<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [
            UserController::class, 'index'
        ])->name('users.index')
        ->can('viewAny', User::class);
        Route::get('/create', [
            UserController::class, 'create'
        ])->name('users.create')
        ->can('create', User::class);
        Route::get('/{user}', [
            UserController::class, 'show'
        ])->name('users.show')
        ->can('view', 'user');
        Route::get('/{user}/edit', [
            UserController::class, 'edit'
        ])->name('users.edit')
        ->can('update', 'user');
        Route::put('/{user}', [
            UserController::class, 'update'
        ])->name('users.update');
        Route::delete('/{user}', [
            UserController::class, 'destroy'
        ])->name('users.destroy')
        ->can('delete', 'user');
        Route::post('/', [
            UserController::class, 'store'
        ])->name('users.store')
        ->can('create', User::class);
    });
    Route::prefix('companies')->group(function () {
        Route::get('/', [
            UserController::class, 'index'
        ])->name('companies.index')
        ->can('viewAny', User::class);
        Route::get('/create', [
            UserController::class, 'create'
        ])->name('companies.create')
        ->can('create', User::class);
        Route::get('/{user}', [
            UserController::class, 'show'
        ])->name('companies.show')
        ->can('view', 'user');
        Route::get('/{user}/edit', [
            UserController::class, 'edit'
        ])->name('companies.edit')
        ->can('update', 'user');
        Route::put('/{user}', [
            UserController::class, 'update'
        ])->name('companies.update');
        Route::delete('/{user}', [
            UserController::class, 'destroy'
        ])->name('companies.destroy')
        ->can('delete', 'user');
        Route::post('/', [
            UserController::class, 'store'
        ])->name('companies.store')
        ->can('create', User::class);
    });
});
