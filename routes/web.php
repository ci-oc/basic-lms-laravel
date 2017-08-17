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
    Route::resource('quizzes', 'QuizController');
    Route::resource('profile', 'ProfileController');
    Route::resource('courses', 'CourseController');
    Route::post('courses/importExcel', ['uses' => 'CourseController@importExcel', 'as' => 'courses.importExcel']);
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('results', 'ResultController');
    Route::resource('enroll', 'RegisterCourseController');
    Route::resource('problems', 'ProblemController');
    Route::resource('users', 'DefaultUserController');
    Route::resource('solve', 'SolveQuizController');
    Route::resource('questions', 'QuestionController');
    Route::post('questions/massDestroy', ['uses' => 'QuestionController@massDestroy', 'as' => 'questions.massDestroy']);
    Route::get('/admin', [
        'as' => 'admin.index',

        'uses' => function () {
            return view('admin.index');
        }
    ]);
});
Route::get('/dashboard', 'HomeController@index')->name('home');

