<?php

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


Route::get('/', function () {
    return view('auth.login');
});




Route::get('exam/{examId}', 'Student\ExamController@startExamView')->name('start.exam.view');
Route::post('exam/{examId}', 'Student\ExamController@startExamPost')->name('start.exam');
ROute::post('submit/exam/','Student\ExamSubmit@submitExam')->name('submit.exam');
ROute::post('update/exam','Student\ExamStatusUpdate@updateExamStatus')->name('update.exam');
Route::get('exam/completed/message','Student\ExamSubmit@examCompletedMEssage')->name('exam.completed.message');

Auth::routes(['register' => false]);
Route::get('/home', 'ExamController@index')->name('home');


Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'auth'], function () {
    Route::get('exam/create', 'ExamController@createExam')->name('exam.create');
    Route::post('exam/store', 'ExamController@storeExam')->name('exam.store');
    Route::get('exam', 'ExamController@index')->name('exam.index');
    Route::get('exam/set/{exam}', 'ExamController@setPaper')->name('exam.set.paper');

    Route::post('exam/add/question/{id}', 'ExamController@addQuestion')->name('exam.add.question');
    Route::get('exam/delete/question/{id}', 'ExamController@deleteQuestion')->name('exam.delete.question');
});
