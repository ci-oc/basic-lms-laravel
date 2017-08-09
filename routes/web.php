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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::get('/admin', [
        'as' => 'admin.index',
        'middleware' => ['role:superuser|standarduser'],
        'uses' => function () {
            return view('admin.index');
        }
    ]);
});
Route::get('/dashboard', 'HomeController@index')->name('home');

Route::resource('quizzes', 'QuizController');
Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@profile']);
Route::resource('courses', 'CourseController');
