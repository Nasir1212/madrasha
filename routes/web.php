<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\HomeController;
// Route::get('/', function () {
//     return view('pages.admin.dashboard');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/print-form', [HomeController::class, 'print_form'])->name('home');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    Route::get('students/print-cards', [dashboardController::class, 'printCards'])->name('students.print.cards');
    Route::resource('students', StudentController::class);
 
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Storage link created successfully!";
});

