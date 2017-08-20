<?php

namespace App\Providers;

use App\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use App\Course;
use App\User;
use App\Quiz;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = User::find(Auth::id())->load('courses.quizzes.questions.options', 'courses.quizzes.questions.testcases', 'courses.quizzes.questions.judge_options');
                $courses = $user['courses'];
                $quizzes = array();
                foreach ($courses as $course) {
                    if ($course['quizzes']->first() !== null)
                        foreach ($course['quizzes'] as $quiz)
                            $quizzes[] = $quiz;
                }
                $all_type_questions = array();
                foreach ($quizzes as $quiz) {
                    if ($quiz['questions'] != null)
                        $all_type_questions[] = $quiz['questions'];
                }
                $questions = Question::separateQuestionTypes($all_type_questions, 'MCQ');
                $problems = Question::separateQuestionTypes($all_type_questions, 'JUDGE');
                $view->with('auth', Auth::user());
                $view->with('courses', $courses);
                $view->with('quizzes', $quizzes);
                $view->with('questions', $questions);
                $view->with('problems', $problems);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
