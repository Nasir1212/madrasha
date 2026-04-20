<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\AdmissionAdminController;
use App\Http\Controllers\HomeController;
 use App\Http\Controllers\Admin\StaffController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/employees', [HomeController::class, 'employees'])->name('employees');
Route::get('/print-form/{form_no}', [HomeController::class, 'print_form'])->name('print_form');
Route::post('/admission-store', [AdmissionController::class, 'store'])->name('admission.store');
Route::get('/admission', [HomeController::class, 'admission_form'])->name('admission_form');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    Route::get('students/print-cards', [dashboardController::class, 'printCards'])->name('students.print.cards');
    Route::resource('students', StudentController::class);
    Route::post('students/add-student/{id}', [StudentController::class, 'add_student'])->name('students.add_student');
    Route::post('/students/bulk-serial-photo', [StudentController::class, 'bulkSerialPhotoUpload'])->name('students.bulk-serial-photo');
    Route::post('/download-doc', [StudentController::class, 'downloadDoc'])->name('download.doc');
    Route::post('/download-doc2', [StudentController::class, 'downloadDoc2'])->name('download.doc2');
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
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/show/{id}', [StaffController::class, 'show'])->name('staff.show');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    
   
    Route::delete('/staff/destroy/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
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