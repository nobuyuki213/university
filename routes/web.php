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

Auth::routes();
// 仮会員確認
Route::post('register/pre_check', 'Auth\RegisterController@preCheck')->name('register.pre_check');
// 本会員登録フォーム
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');
// 本会員確認
Route::post('register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');
// 本会員登録
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', 'UsersController', ['only' => ['show']]);
Route::post('avatar', 'UploadController@updateAvatar')->name('avatar.update');

Route::group(['prefix' => 'user/{user_id}'], function(){
	Route::post('sending', 'UserMessageController@store')->name('user.sending');
	Route::get('messages', 'UserMessageController@show')->name('user.messages');
});



Route::resource('university', 'UniversitiesController', ['only' => ['index', 'show', 'create', 'store']]);

Route::resource('faculty', 'FacultiesController', ['only' => ['create', 'store']]);

Route::get('school', 'UniversitiesSearchController@school')->name('school');

