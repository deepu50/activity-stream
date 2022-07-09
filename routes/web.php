<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentMarkController;

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

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/dashboard',[StudentController::class,'index'])->name('dashboard');
Route::post('/student_add',[StudentController::class,'store'])->name('student_add');
Route::get('/edit/{id}',[StudentController::class,'edit'])->name('edit');
Route::post('/delete/{id}',[StudentController::class,'delete'])->name('delete');

//Marks
Route::get('/student_marks',[StudentMarkController::class,'index'])->name('student_marks');
Route::post('/marks_add',[StudentMarkController::class,'store'])->name('marks_add');
Route::get('/edit-marks/{id}',[StudentMarkController::class,'edit'])->name('edit-marks');
Route::post('/marks_delete/{id}',[StudentMarkController::class,'delete'])->name('delete');


require __DIR__.'/auth.php';
