<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
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

Route::get('/',[StudentController::class,'StudentView'])->name('student_view');
Route::get('/home',[StudentController::class,'StudentView'])->name('student_view');
Route::get('/student/new',[StudentController::class,'StudentAdd'])->name('student_add');
Route::post('/add/student/store',[StudentController::class,'StudentStore'])->name('student_store');
Route::get('/edit/student/{id}',[StudentController::class,'StudentEdit'])->name('student_edit');
Route::post('/edit/student/update',[StudentController::class,'StudentUpdate'])->name('student_update');
Route::get('/delete/student/{id}',[StudentController::class,'StudentDelete'])->name('student_delete');
   

Route::prefix('result')->group(function(){    
    Route::get('/student/{id}/view',[CourseController::class,'CouseView'])->name('result.course_view');
    Route::get('/student/{id}/course/new',[CourseController::class,'CourseAdd'])->name('result.course_add');
    Route::post('/add/student/{id}/course/store',[CourseController::class,'CourseStore'])->name('result.course_store');
    Route::get('/edit/student/{id}/course/{course}',[CourseController::class,'CourseEdit'])->name('result.course_edit');
    Route::post('/edit/student/{id}/course/{course}/update',[CourseController::class,'CourseUpdate'])->name('result.course_update');
    Route::get('/delete/student/{id}/course/{course}',[CourseController::class,'CourseDelete'])->name('result.course_delete');
});
