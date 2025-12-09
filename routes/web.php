<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('pages.admin.dashboard');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/print-form/{form_no}', [HomeController::class, 'print_form'])->name('print_form');
Route::post('/admission-store', [AdmissionController::class, 'store'])->name('admission.store');
Route::get('/admission-form', [HomeController::class, 'admission_form'])->name('admission_form');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    Route::get('students/print-cards', [dashboardController::class, 'printCards'])->name('students.print.cards');
    Route::resource('students', StudentController::class);
 
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Storage link created successfully!";
});


Route::get('/clear-all', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('optimize:clear');
    $exitCode = Artisan::call('optimize');
    echo "clear";
    // return what you want
});