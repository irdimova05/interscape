<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
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

Route::get('/interests', function () {
    return view('interests');
})->middleware(['auth', 'verified'])->name('interests');

Route::get('/employers', function () {
    return view('employers');
})->middleware(['auth', 'verified'])->name('employers');

Route::get('/students', function () {
    return view('students');
})->middleware(['auth', 'verified'])->name('students');

Route::middleware('auth')->group(function () {
    Route::resource('ads', AdController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
