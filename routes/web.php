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

Route::post('/language')->uses('LanguageController@index')->middleware('lang')->name('lang');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/plagiarism')->uses('PlagiarismController@index')->name('plagiarism');
    Route::get('/downloadTemp', 'DefaultUserController@downloadTemp');
    Route::get('securityQuestions/show')->uses('SecurityQuestionController@index2')->name('securityQuestions.index2');
    Route::get('securityQuestions/edit')->uses('SecurityQuestionController@index')->name('securityQuestions.index');
    Route::get('securityQuestions/store')->uses('SecurityQuestionController@index3')->name('securityQuestions.index3');
    Route::get('securityQuestions/store/store_question')->uses('SecurityQuestionController@store_question')->name('securityQuestions.store_question');
    Route::get('ojConfiguration', 'JudgeConstraintController@index')->name('Judge.index');
    Route::get('ojConfiguration/edit', 'JudgeConstraintController@store')->name('Judge.store');
    Route::resource('securityQuestions', 'SecurityQuestionController');
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('quizzes/chart/{id}')->uses('QuizController@chart')->name('quizzes.chart');
    Route::get('quizzes/results/{id}')->uses('QuizController@results')->name('quizzes.results');
    Route::resource('quizzes', 'QuizController');
    Route::resource('profile', 'ProfileController');
    Route::post('profile/update_image')->uses('ProfileController@update_image')->name('profile.update_image');
    Route::post('profile/update')->uses('ProfileController@update')->name('profile.update');
    Route::delete('courses/destroy/material/{id}')->uses('CourseController@destroy_material')->name('courses.destroy_material');
    Route::resource('courses', 'CourseController');
    Route::post('course/update')->uses('CourseController@update')->name('courses.update');
    Route::post('courses/importExcel')->uses('CourseController@importExcel')->name('courses.importExcel');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('submissions', 'SubmissionsController');
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
    Route::get('/script', function () {
        return view('no_script');
    })->name('noScript');
    Route::get('/construction', function () {
        return view('under_construction');
    })->name('under_construction');
    Route::get('/{url}', function ($url) {
        $valid_url = \App\Url::pluck('url')->first();
        if ($valid_url == $url)
            return view('admin.index', compact('valid_url'));
        else
            return redirect()->back();
    })->name('admin.index');


    Route::get('courses/download/materials/{filename}/{filedec}', function ($filename, $file_dec) {
        $material_path = 'materials' . DIRECTORY_SEPARATOR . $filename;
        $file_path = storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $material_path;
        if (file_exists($file_path)) {
            $path = storage_path('app/materials/' . $filename);
            return response()->download($file_path, $file_dec);
        } else {
            return redirect()->back()->with('file-not-exist', '');
        }
    })->where('filename', '[A-Za-z0-9\-\_\.]+');
});

