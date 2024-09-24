<?php

use App\Http\Controllers\SafeController;
use App\Http\Controllers\VulnerableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [VulnerableController::class, 'showLoginForm'])->name('login');
Route::post('/login', [VulnerableController::class, 'vulnerableLogin'])->name('vulnerable.login');
Route::post('/safe-login', [SafeController::class, 'safeLogin'])->name('safe.login');

// Routes vulnérables
Route::prefix('vulnerable')->group(function () {
    Route::get('/search', [VulnerableController::class, 'vulnerableSearch'])->name('vulnerable.search');
    Route::post('/comment', [VulnerableController::class, 'vulnerableComment'])->name('vulnerable.comment');
    Route::post('/update-profile', [VulnerableController::class, 'vulnerableUpdate'])->name('vulnerable.update');
    Route::post('/create-post', [VulnerableController::class, 'createPost'])->name('vulnerable.createPost');
    Route::post('/add-credit-card', [VulnerableController::class, 'addCreditCard'])->name('vulnerable.addCreditCard');
    Route::delete('/delete-post/{id}', [VulnerableController::class, 'deletePost'])->name('vulnerable.deletePost');
});

// Routes sécurisées
Route::prefix('safe')->group(function () {
    Route::get('/search', [SafeController::class, 'safeSearch'])->name('safe.search');
    Route::post('/create-post', [SafeController::class, 'safeCreatePost'])->name('safe.createPost');
    Route::post('/add-credit-card', [SafeController::class, 'safeAddCreditCard'])->name('safe.addCreditCard');
    Route::delete('/delete-post/{id}', [SafeController::class, 'safeDeletePost'])->name('safe.deletePost');
});

// Routes communes
Route::get('/comments', [VulnerableController::class, 'showComments'])->name('comments');
Route::get('/profile', [VulnerableController::class, 'showProfile'])->name('profile');

//Route::post('/logout', [VulnerableController::class, 'logout'])->name('logout');
