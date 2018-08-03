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

Route::resource('university', 'UniversitiesController', ['only' => ['index', 'show', 'create', 'store']]);

