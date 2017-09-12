<?php

namespace App\Providers;

use App\JudgesConstraint;
use App\News;
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
                $judge_constraints = JudgesConstraint::get()->first()->toArray();
                $news = News::all();
                $user = User::find(Auth::id())
                    ->load('courses.quizzes.questions.options',
                        'courses.quizzes.questions.testcases',
                        'courses.quizzes.questions.judge_options'
                        , 'courses.quizzes.questions.coding_languages',
                        'courses.announcements.user');
                $announcements = array();
                $courses = $user['courses'];
                $quizzes = array();
                foreach ($courses as $course) {
                    if (count($course->announcements) > 0)
                        $announcements[] = $course->announcements;
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
                $view->with('all_news', $news);
                $view->with('announcements', $announcements);
                $view->with('judge_constraints', $judge_constraints);
                if (Auth::user()->isSuperuser()) {
                    $url = \App\Url::pluck('url')->first();
                    $view->with('valid_url', $url);
                }
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
