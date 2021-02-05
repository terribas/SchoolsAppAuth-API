<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AuthController;


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::resource('school', SchoolController::class, ['except'=> ['create', 'edit']])->middleware('auth:api');
Route::resource('teacher', TeacherController::class, ['except'=> ['create', 'edit']])->middleware('auth:api');
Route::post('save_image', [TeacherController::class, 'save_image'])->name('save_image')->middleware('auth:api');
Route::get('school_and_teachers', [SchoolController::class, 'school_and_teachers'])->name('school_and_teachers')->middleware('auth:api');
Route::get('teachers_of/{id}', [TeacherController::class, 'teachers_of'])->name('teachers_of')->middleware('auth:api');


