<?php
// Admin Route 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// Profile Link
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile-update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');
