<?php

use App\Http\Controllers\Staff\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Staff\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Staff\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Staff\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Staff\Auth\NewPasswordController;
use App\Http\Controllers\Staff\Auth\PasswordController;
use App\Http\Controllers\Staff\Auth\PasswordResetLinkController;
use App\Http\Controllers\Staff\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:staff')->group(function () {

    Route::get('staff/login', [AuthenticatedSessionController::class, 'create'])
        ->name('staff.login');

    Route::post('staff/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('staff/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('staff.password.request');

    Route::post('staff/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('staff.password.email');

    Route::get('staff/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('staff.password.reset');

    Route::post('staff/reset-password', [NewPasswordController::class, 'store'])
        ->name('staff.password.store');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('staff/verify-email', EmailVerificationPromptController::class)
        ->name('staff.verification.notice');

    Route::get('staff/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('staff.verification.verify');

    Route::post('staff/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('staff.verification.send');

    Route::get('staff/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('staff.password.confirm');

    Route::post('staff/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('staff/password', [PasswordController::class, 'update'])->name('staff.password.update');

    Route::post('staff/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('staff.logout');
});
