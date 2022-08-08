<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {return view('welcome');});

Route::middleware('auth')->group(function () 
{
    Route::get('/dashboard',[PageController::class, 'showDashboard'])->middleware(['auth'])->name('dashboard');
    Route::get('/download/{file}', [StudentController::class, 'download'])->name('file.download');      
    Route::post('dashboard', [TeacherController::class, 'fileUpload'])->name('file.upload');
});

require __DIR__ . '/auth.php';
