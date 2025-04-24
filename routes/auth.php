<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Models\Company;
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
            CompanyController::class, 'index'
        ])->name('companies.index')
        ->can('viewAny', Company::class);
        Route::get('/create', [
            CompanyController::class, 'create'
        ])->name('companies.create')
        ->can('create', Company::class);
        Route::get('/{company}', [
            CompanyController::class, 'show'
        ])->name('companies.show')
        ->can('view', 'company');
        Route::get('/{company}/edit', [
            CompanyController::class, 'edit'
        ])->name('companies.edit')
        ->can('update', 'company');
        Route::put('/{company}', [
            CompanyController::class, 'update'
        ])->name('companies.update');
        Route::delete('/{company}/destroy', [
            CompanyController::class, 'destroy'
        ])->name('companies.destroy')
        ->can('delete', 'company');
        Route::post('/', [
            CompanyController::class, 'store'
        ])->name('companies.store')
        ->can('create', Company::class);
    });

    Route::prefix('clients')->group(function () {
        Route::get('/', [
            UserController::class, 'index'
        ])->name('clients.index')
        ->can('viewAny', User::class);
        Route::get('/create', [
            UserController::class, 'create'
        ])->name('clients.create')
        ->can('create', User::class);
        Route::get('/{user}', [
            UserController::class, 'show'
        ])->name('clients.show')
        ->can('view', 'user');
        Route::get('/{user}/edit', [
            UserController::class, 'edit'
        ])->name('clients.edit')
        ->can('update', 'user');
        Route::put('/{user}', [
            UserController::class, 'update'
        ])->name('clients.update');
        Route::delete('/{user}', [
            UserController::class, 'destroy'
        ])->name('clients.destroy')
        ->can('delete', 'user');
        Route::post('/', [
            UserController::class, 'store'
        ])->name('clients.store')
        ->can('create', User::class);
    });

    Route::get('/pdf/{client}/firmar', [ClientController::class, 'form'])
    ->name('pdf.form');
    Route::get('/pdf/{clientId}/generar-plantilla', [ClientController::class, 'generarPlantilla'])
    ->name('pdf.plantilla');

Route::post('/pdf/{client}/firmar', [ClientController::class, 'firmar'])
    ->name('pdf.firmar');
    Route::get('pdf/descargar/{client}', [ClientController::class, 'descargar'])->name('pdf.download');


});
