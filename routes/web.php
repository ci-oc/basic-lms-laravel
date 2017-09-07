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
Route::get('send', 'MailController@StudentView'); // just for testing mail view , will be deleted
Route::get('sendi', 'MailController@instructorView'); // just for testing mail view , will be deleted
Route::get('sendMail', 'MailController@index'); // just for testing sendig mail , will be deleted

Route::group(['middleware' => 'auth'], function () {
    Route::get('securityQuestions/show')->uses('SecurityQuestionController@index2')->name('securityQuestions.index2');
    Route::get('securityQuestions/edit')->uses('SecurityQuestionController@index')->name('securityQuestions.index');
    Route::get('securityQuestions/index3')->uses('SecurityQuestionController@index3')->name('securityQuestions.index3');
    Route::get('securityQuestions/index3/store_question')->uses('SecurityQuestionController@store_question')->name('securityQuestions.store_question');
     // el route dah fe moshkla ely fo2 msh rady yezbot
    Route::resource('securityQuestions','SecurityQuestionController');
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('quizzes/chart/{id}')->uses('QuizController@chart')->name('quizzes.chart');
    Route::get('quizzes/results/{id}')->uses('QuizController@results')->name('quizzes.results');
    Route::resource('quizzes', 'QuizController');
    Route::resource('profile', 'ProfileController');
    Route::post('profile/update_image')->uses('ProfileController@update_image')->name('profile.update_image');
    Route::post('profile/update')->uses('ProfileController@update')->name('profile.update');
    Route::resource('courses', 'CourseController');
    Route::post('course/update')->uses('CourseController@update')->name('courses.update');
    Route::post('courses/importExcel')->uses('CourseController@importExcel')->name('courses.importExcel');
    Route::resource('user', 'UserController');
    Route::resource('submissions', 'SubmissionsController');
    Route::resource('role','RoleController');
    Route::resource('results', 'ResultController');
    Route::resource('enroll', 'RegisterCourseController');
    Route::resource('problems', 'ProblemController');
    Route::resource('users', 'DefaultUserController');
    Route::post('users/store_single')->uses('DefaultUserController@store_single')->name('users.store_single');
    Route::resource('solve', 'SolveQuizController');
    Route::resource('questions', 'QuestionController');
    Route::resource('news', 'NewsController');
    Route::resource('announcements', 'AnnouncementsController');
    Route::post('questions/massDestroy')->uses('QuestionController@massDestroy')->name('questions.massDestroy');
    Route::get('/{url}', function ($url) {
        $valid_url = \App\Url::pluck('url')->first();
        if ($valid_url == $url)
            return view('admin.index',compact('valid_url'));
        else
            abort(404);
    })->middleware('role:superuser|standard-user')->name('admin.index');
    Route::get('/noScript', function () {
        return view('noscript');
    })->name('noScript');
});

