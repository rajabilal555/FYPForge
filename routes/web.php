<?php

use App\Http\Controllers\Staff\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('staff.login'),
        'canRegister' => Route::has('staff.register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');


Route::prefix('staff')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Staff/Dashboard');
    })->middleware(['auth', 'verified'])->name('staff.dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('staff.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('staff.profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('staff.profile.destroy');
    });
});

require __DIR__ . '/auth.php';
