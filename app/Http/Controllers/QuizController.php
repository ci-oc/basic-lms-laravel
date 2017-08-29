<?php

namespace App\Http\Controllers;

use App\UsersQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quiz;
use App\Question;
class QuizController extends Controller
{
    /**
     * QuizController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:create-quiz', ['only' => ['create']]);
        $this->middleware('permission:edit-quiz', ['only' => ['edit']]);
        $this->middleware('permission:show-quiz-statistics', ['only' => ['chart']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solved_quizzes = UsersQuiz::with('quiz')->where('user_id', '=', Auth::id())->get();
        return view('quiz.index', compact('solved_quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (count(Auth::user()->courses) > 0)
            return view('quiz.create');
        else
            return redirect()->back()->with('courses_0', '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Quiz::create($request->all());
        return redirect()->route('quizzes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::findorFail($id)->load('questions');
        if(!Quiz::hasFinished($quiz->end_date) && Quiz::isAvailable($quiz->start_date,$quiz->end_date)) {
            $all_type_questions[] = $quiz->questions;
            $quiz_questions =  Question::separateQuestionTypes($all_type_questions, 'MCQ');
            $quiz_problems = Question::separateQuestionTypes($all_type_questions,'JUDGE');
            $solve_many = $quiz->solve_many;
            $grade = UsersQuiz::where([['user_id', '=', Auth::id()],
                ['quiz_id', '=', $id]])->pluck('grade')->toArray();
            if ($grade == null || $solve_many) {
                if (count($quiz->questions) > 0)
                    return view('quiz.show', compact('id', 'solve_many','quiz_questions','quiz_problems','quiz'));
                else
                    return redirect()->back()->with('0_questions', '');
            }
            return redirect()->back()->with('done_already', '');
        }
        return redirect()->back()->with('not_available','');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function chart($id)
    {
        $solved_quiz = UsersQuiz::with('user', 'quiz')->where('quiz_id', '=', $id)->get();
        if ($solved_quiz->first() != null) {
            $chart_data[] = ['Name', 'Grade'];
            foreach ($solved_quiz as $quiz) {
                $chart_data[] = [$quiz->user->name, $quiz->grade];
            }
            return view('quiz.chart')->with('chart_data', json_encode($chart_data));
        } else
            return redirect()->back()->with('none-solved', '');
    }
}
