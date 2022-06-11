<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


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
    return view('welcome');
});

Route::get('/dashboard',[StudentController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::post('/student_add',[StudentController::class,'store'])->name('student_add');
Route::get('/edit/{id}',[StudentController::class,'edit'])->name('edit');
Route::get('/list',[StudentController::class,'list'])->name('list');
Route::post('/delete/{id}',[StudentController::class,'delete'])->name('delete');


require __DIR__.'/auth.php';
