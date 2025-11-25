<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\StudentController;
// Route::get('/', function () {
//     return view('pages.admin.dashboard');
// });

Route::get('/', [StudentController::class, 'printCards'])->name('students.print.cards');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    Route::resource('students', StudentController::class);
    Route::get('students/print-cards', [StudentController::class, 'printCards'])->name('students.print.cards');
 
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Storage link created successfully!";
});

