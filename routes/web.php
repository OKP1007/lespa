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

Route::get('/', 'LessonListController@index')->name('/');
Route::get('/home', 'LessonListController@index')->name('home');

// ログイン
Route::get('/loginCheck', 'HomeController@login')->name('loginCheck');

// レッスン
Route::get('/lessonList', 'LessonListController@index')->name('lessonList');
Route::get('/lessonList/search', 'LessonListController@search')->name('lessonList.search');
Route::get('/lesson/{urlToken}', 'LessonController@index')->name('lesson');
Route::post('/lessonConfirm', 'LessonConfirmController@index')->name('lessonConfirm');
Route::post('/lessonConfirm/submit', 'LessonConfirmController@submit')->name('lessonConfirm.submit');
Route::post('/lessonCancelConfirm', 'LessonCancelConfirmController@index')->name('lessonCancelConfirm');
Route::post('/lessonCancelConfirm/submit', 'LessonCancelConfirmController@submit')->name('lessonCancelConfirm.submit');
Route::get('/create', 'PostsController@index')->name('create');
Route::post('/create/create', 'PostsController@create')->name('create.create');

// レッスン登録
Route::get('/addLesson', 'AddLessonController@index')->name('addLesson');
Route::post('/addLesson/create', 'AddLessonController@create')->name('addLesson.create');
Route::get('/lessonEdit/{urlToken}', 'AddLessonController@edit')->name('lessonEdit');
Route::post('/lessonUpdate', 'AddLessonController@update')->name('lessonUpdate');
Route::get('/payment', 'PaymentController@index')->name('payment');

// プロフィール
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/edit', 'ProfileController@edit')->name('edit');
Route::post('/profile/update', 'ProfileController@update')->name('update');

// イントラ
Route::get('/instructor', 'InstructorController@index')->name('instructor');
Route::get('/instructor/edit', 'InstructorController@edit')->name('instructor.edit');
Route::post('/instructor/submit', 'InstructorController@submit')->name('instructor.submit');
Route::post('/instructor/update', 'InstructorController@update')->name('instructor.update');

// LINE連携
Route::get("api/login", "Api\LoginController@showLoginForm")->name("api.login");
Route::post("api/login", "Api\LoginController@login");
Route::get('/lineLogin', 'LineLoginController@index')->name('lineLogin');
Route::get('/login', 'LessonListController@login')->name('login');
Route::get('/logout', 'LineLoginController@logout')->name('logout');