<?php

namespace App\Http\Controllers;

use App\UsersQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quiz;

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
        return view('quiz.create');
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
        $quiz = Quiz::find($id);
        $solve_many = $quiz->solve_many;
        $grade = UsersQuiz::where('user_id', '=', Auth::id())->where('quiz_id', '=', $id)->pluck('grade')->toArray();
        if (floatval($grade) == null || $solve_many) {
            return view('quiz.show', compact('id', 'solve_many'));
        }
        return redirect()->back()->with('done_already', '');
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
