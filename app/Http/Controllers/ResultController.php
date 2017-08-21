<?php

namespace App\Http\Controllers;

use App\UsersAnswer;
use App\UsersProblemAnswer;
use App\UsersQuiz;
use App\UsersTestCaseAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * ResultController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:solve-quiz', ['only' => 'index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = UsersQuiz::with('user', 'quiz')->whereHas('user', function ($q) {
            return $q->where('user_id', '=', Auth::id());
        })->get();
        return view('results.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz_result = UsersQuiz::find($id)->load('user', 'quiz');
        $questions_results = UsersAnswer::where([
            ['user_id', '=', Auth::id()],
            ['quiz_id', '=', $quiz_result->quiz_id]
        ])->get();
        $problems_results = UsersProblemAnswer::where([
            ['user_id', '=', Auth::id()],
            ['quiz_id', '=', $quiz_result->quiz_id]
        ])->get();
        $problems_id = array();
        foreach ($problems_results as $result) {
            $problems_id[] = $result->problem_id;
        }
        $testcases_results = UsersTestCaseAnswer::where('user_id', '=', Auth::id())->whereIn('problem_id', $problems_id)->get();
        return view('results.show', compact('quiz_result', 'questions_results', 'problems_results','testcases_results'));
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
        //
    }
}
