<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('auth/user', UserController::class);
    $router->resource('auth/university', UniversityController::class);
    $router->resource('auth/faculty', FacultyController::class);
    $router->resource('auth/facultycontent', FacultyContentController::class);
    $router->resource('auth/course', CourseController::class);
    $router->resource('auth/coursecontent', CourseContentController::class);
    $router->resource('auth/review', ReviewController::class);

});
