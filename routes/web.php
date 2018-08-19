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

// Route::get('/home', 'HomeController@index')->name('home');
// トップページ画面
Route::get('/', 'WelcomeController@welcome');

// ログイン認証設定
Route::group(['middleware' => ['auth']], function() {
	// ユーザーページ画面
	Route::resource('user', 'UsersController', ['only' => ['show']]);
	Route::post('avatar', 'UploadController@updateAvatar')->name('avatar.update');
	// ユーザーメッセージ機能関係
	Route::group(['prefix' => 'user/{user_id}'], function(){
		Route::post('sending', 'UserMessageController@store')->name('user.sending');
		Route::get('messages', 'UserMessageController@show')->name('user.messages');
	});
	// レビュー機能関連
	Route::group(['prefix' => 'review'], function(){
		Route::get('select', 'UniversityReviewController@select')->name('university.select');
		Route::get('input', 'UniversityReviewController@input')->name('review.input');
		Route::post('comfirm', 'UniversityReviewController@comfirm')->name('review.comfirm');
		// レビュー登録
		Route::resource('review', 'ReviewsController', ['only' => ['store']]);
		// レビュー登録完了画面
		Route::get('complete', 'ReviewsController@complete')->name('review.complete');
	});
	// 大学の授業サーチ画面
	Route::resource('university', 'UniversitiesController', ['only' => ['show']]);
	// 授業ページ画面
	Route::resource('lesson', 'LessonsController', ['only' => ['show']]);
});

// 大学選択ページ画面
Route::get('school', 'UniversitiesSearchController@school')->name('school');





// 以下ののルーティンはLaravel/admin で対応するためイ不要になると思われる
Route::resource('faculty', 'FacultiesController', ['only' => ['create', 'store']]);
Route::resource('courses', 'CoursesController', ['only' => ['create', 'store']]);

Route::resource('university', 'UniversitiesController', ['only' => ['index', 'create', 'store']]);
// Route::get('university/{id}/setting', 'UniversitiesController@setting')->name('university.setting');// 大学の設定ページ予定（仮）
Route::group(['prefix' => 'university/{u_id}'], function(){
	Route::get('setting_faculty', 'FacultyContentsController@create')->name('setting.faculty');// 大学の学部を選択するページ
	Route::post('add_faculty', 'FacultyContentsController@store')->name('add.faculty');
	Route::get('edit_faculty', 'FacultyContentsController@edit')->name('edit.faculty');
	Route::put('update_faculty', 'FacultyContentsController@update')->name('update.faculty');

	Route::group(['prefix' => 'faculty'], function(){
		Route::get('select', 'CourseContentsController@select')->name('faculty.select');
		});

	Route::group(['prefix' => 'faculty/{f_id}'], function(){
		Route::resource('course', 'CourseContentsController', ['only' => ['create', 'store', 'edit', 'update']]);
	});
});