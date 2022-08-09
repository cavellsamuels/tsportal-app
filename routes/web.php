<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'showDashboard'])->middleware(['auth'])->name('dashboard');
    Route::get('/download/{file}', [UserController::class, 'fileDownload'])->name('file.download');
    Route::post('dashboard', [UserController::class, 'fileUpload'])->name('file.upload');
});

require __DIR__.'/auth.php';
