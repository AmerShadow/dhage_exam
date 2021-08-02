<?php

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

use Illuminate\Routing\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('exam','ExamController@exams')->route('exams');
    Route::get('exam/create','ExamController@createExam')->name('exam.create');
    Route::post('exam/store','ExamController@storeExam')->name('exam.store');

});


