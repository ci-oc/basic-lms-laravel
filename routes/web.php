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
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::resource('quizzes', 'QuizController');
    Route::resource('profile', 'ProfileController');
    Route::post('profile/update_image', ['uses' => 'ProfileController@update_image', 'as' => 'profile.update_image']);
    Route::post('profile/update', ['uses' => 'ProfileController@update', 'as' => 'profile.update']);
    Route::resource('courses', 'CourseController');
    Route::post('courses/importExcel', ['uses' => 'CourseController@importExcel', 'as' => 'courses.importExcel']);
    Route::resource('user', 'UserController');
    Route::resource('submissions', 'SubmissionsController');
    Route::resource('role', 'RoleController');
    Route::resource('results', 'ResultController');
    Route::resource('enroll', 'RegisterCourseController');
    Route::resource('problems', 'ProblemController');
    Route::resource('users', 'DefaultUserController');
    Route::post('users/store_single', ['uses' => 'DefaultUserController@store_single', 'as' => 'users.store_single']);
    Route::resource('solve', 'SolveQuizController');
    Route::resource('questions', 'QuestionController');
    Route::post('questions/massDestroy', ['uses' => 'QuestionController@massDestroy', 'as' => 'questions.massDestroy']);
    Route::get('/admin', [
        'as' => 'admin.index',
        'middleware' => ['role:superuser|standard-user'],
        'uses' => function () {
            return view('admin.index');
        }
    ]);
});

