<?php

namespace App\Http\Controllers;

use App\User;
use App\Quiz;
use App\UsersQuiz;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students_count = User::where('college_id', '!=', null)->count();
        $professors_count = User::where('college_id', '=', null)->count();
        $quizzes_count = Quiz::all()->count();
        $submissions_count = UsersQuiz::all()->count();
        return view('home', compact('students_count', 'professors_count','quizzes_count','submissions_count'));
    }
}
