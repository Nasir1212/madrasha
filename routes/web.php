<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\AdmissionAdminController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('pages.admin.dashboard');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/print-form/{form_no}', [HomeController::class, 'print_form'])->name('print_form');
Route::post('/admission-store', [AdmissionController::class, 'store'])->name('admission.store');
Route::get('/admission', [HomeController::class, 'admission_form'])->name('admission_form');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    Route::get('students/print-cards', [dashboardController::class, 'printCards'])->name('students.print.cards');
    Route::resource('students', StudentController::class);

    Route::get('/print-receive/{form_no}', [AdmissionAdminController::class, 'print_receive'])
        ->name('admissions.print_receive');
    Route::get('/admissions', [AdmissionAdminController::class, 'index'])
        ->name('admissions.index');

    Route::get('/admissions/{id}/edit', [AdmissionAdminController::class, 'edit'])
        ->name('admissions.edit');

    Route::put('/admissions/{id}', [AdmissionAdminController::class, 'update'])
        ->name('admissions.update');

    Route::delete('/admissions/{id}', [AdmissionAdminController::class, 'destroy'])
        ->name('admissions.delete');

    Route::post('/admissions/{id}/approve', [AdmissionAdminController::class, 'approve'])
        ->name('admissions.approve');

    Route::post('/admissions/{id}/reject', [AdmissionAdminController::class, 'reject'])
        ->name('admissions.reject');

 
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