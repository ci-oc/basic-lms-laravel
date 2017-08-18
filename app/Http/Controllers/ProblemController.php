<?php

namespace App\Http\Controllers;

use App\JudgeOptions;
use App\ProblemJudgeOptions;
use App\TestsCase;
use Illuminate\Http\Request;
use App\Question;

class ProblemController extends Controller
{
    /**
     * ProblemController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:instructor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('problems.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $judge_options = JudgeOptions::all();
        return view('problems.create', compact('judge_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = Question::create($request->all());
        $quiz = Quiz::find($request->input('quiz_id'));
        $quiz_fullmark = $quiz->full_mark;
        $question_grade = $request->input('grade');
        $quiz_fullmark += $question_grade;
        $quiz->update(['full_mark' => $quiz_fullmark]);
        $input_test_cases = $request->input('input_testcase');
        $output_test_cases = $request->input('output_testcase');
        $judge_options = $request->input('judge_options');
        for ($i = 0; $i < count($input_test_cases); $i++) {
            TestsCase::create([
                'question_id' => $question->id,
                'input' => $input_test_cases[$i],
                'output' => $output_test_cases[$i],
            ]);
        }
        for ($i = 0; $i < count($judge_options); $i++) {
            ProblemJudgeOptions::create([
                'problem_id' => $question->id,
                'judge_id' => $judge_options[$i],
            ]);
        }
        return redirect()->route('problems.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
