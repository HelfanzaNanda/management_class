<?php

use App\Http\Controllers\{ClassController, HomeController, StudentController, TeacherController};
use Illuminate\Support\Facades\{Auth, Route};


Route::middleware('auth')->group(function(){
	
	Route::prefix('class')->group(function() {
		Route::get('/', [ClassController::class, 'index'])->name('class.index');
		Route::post('/createOrUpdate', [ClassController::class, 'createOrUpdate'])->name('class.createOrUpdate');
		Route::post('/students', [ClassController::class, 'addStudents'])->name('class.students');
		Route::get('/{id}/detail', [ClassController::class, 'detail'])->name('class.detail');
		Route::delete('/{id}/delete', [ClassController::class, 'delete'])->name('class.delete');
	});

	Route::prefix('teacher')->group(function() {
		Route::get('/', [TeacherController::class, 'index'])->name('teacher.index');
		Route::post('/createOrUpdate', [TeacherController::class, 'createOrUpdate'])->name('teacher.createOrUpdate');
		Route::get('/{id}/detail', [TeacherController::class, 'detail'])->name('teacher.detail');
		Route::delete('/{id}/delete', [TeacherController::class, 'delete'])->name('teacher.delete');
	});

	Route::prefix('student')->group(function() {
		Route::get('/', [StudentController::class, 'index'])->name('student.index');
		Route::post('/createOrUpdate', [StudentController::class, 'createOrUpdate'])->name('student.createOrUpdate');
		Route::get('/{id}/detail', [StudentController::class, 'detail'])->name('student.detail');
		Route::delete('/{id}/delete', [StudentController::class, 'delete'])->name('student.delete');
	});

	Route::get('', [HomeController::class, 'index'])->name('home');	

});



Auth::routes();
