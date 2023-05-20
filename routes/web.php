<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ReportedAdController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'complete.profile', 'inactive.profile'])->group(function () {
    Route::get('ads/search', [AdController::class, 'search'])->name('ads.search');
    Route::put('ads/{ad}/status', [AdController::class, 'status'])->name('ads.status');
    Route::resource('ads', AdController::class);

    Route::get('applies/adsFilter', [ApplyController::class, 'adsFilter'])->name('applies.adsFilter');
    Route::get('/apply/{ad}', [ApplyController::class, 'create'])->name('ads.apply');
    Route::put('/applies/{apply}/approve', [ApplyController::class, 'approve'])->name('applies.approve');
    Route::put('/applies/{apply}/reject', [ApplyController::class, 'reject'])->name('applies.reject');
    Route::resource('applies', ApplyController::class)->only(['index', 'show', 'store']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('interests', InterestsController::class);

    Route::resource('favorites', FavoritesController::class);

    Route::resource('reported-ads', ReportedAdController::class);
    Route::post('reported-ads/{ad}', [ReportedAdController::class, 'store'])->name('reported-ads.store');
    Route::put('reported-ads/{ad}/status', [ReportedAdController::class, 'update'])->name('reported-ads.update');

    Route::resource('employers', EmployerController::class);

    Route::resource('students', StudentController::class);

    Route::get('/download-template', [UserController::class, 'downloadTemplate'])->name('download.template');

    Route::post('users/import', [UserController::class, 'import'])->name('users.import');
    Route::get('users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);
    Route::put('users/{user}/status', [UserController::class, 'status'])->name('users.status');
});



require __DIR__ . '/auth.php';
