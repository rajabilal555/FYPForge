<?php

// use App\Http\Controllers\Staff\AdvisorController;
// use App\Http\Controllers\Staff\ProfileController;
// use App\Http\Controllers\Staff\StudentController;
use App\Http\Controllers\Staff;
use App\Http\Controllers\Student;
use App\Http\Controllers\Advisor;
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
        Route::get('/profile', [Staff\ProfileController::class, 'edit'])->name('staff.profile.edit');
        Route::patch('/profile', [Staff\ProfileController::class, 'update'])->name('staff.profile.update');
        Route::delete('/profile', [Staff\ProfileController::class, 'destroy'])->name('staff.profile.destroy');

        Route::resource('/student', Staff\StudentController::class, ['names' => 'staff.student']);
        Route::resource('/advisor', Staff\AdvisorController::class, ['names' => 'staff.advisor']);
    });
});

Route::prefix('advisor')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Advisor/Dashboard');
    })->middleware(['auth', 'verified'])->name('advisor.dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [Advisor\ProfileController::class, 'edit'])->name('advisor.profile.edit');
        Route::patch('/profile', [Advisor\ProfileController::class, 'update'])->name('advisor.profile.update');
        Route::delete('/profile', [Advisor\ProfileController::class, 'destroy'])->name('advisor.profile.destroy');
    });
});


Route::prefix('student')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Student/Dashboard');
    })->middleware(['auth:student', 'verified'])->name('student.dashboard');

    Route::middleware('auth:student')->group(function () {
        Route::get('/profile', [Student\ProfileController::class, 'edit'])->name('student.profile.edit');
        Route::patch('/profile', [Student\ProfileController::class, 'update'])->name('student.profile.update');
        Route::delete('/profile', [Student\ProfileController::class, 'destroy'])->name('student.profile.destroy');
    });
});

require __DIR__ . '/auth.php';
