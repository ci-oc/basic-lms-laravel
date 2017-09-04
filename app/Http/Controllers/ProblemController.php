<?php

namespace App\Http\Controllers;

use App\codingLanguages;
use App\JudgeOptions;
use App\ProblemJudgeOptions;
use App\TestsCase;
use Illuminate\Http\Request;
use App\Question;
use App\Quiz;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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
        $coding_languages = codingLanguages::all();
        return view('problems.create', compact('judge_options', 'coding_languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->input('grade') == null || $request->input('grade') <= 0) {
            return \redirect()->back()->withInput()->with('grade-failed', '');
        }
        $coding_languages = $request->input('coding_languages');
        $question = Question::create($request->all());
        $question->coding_languages()->attach($coding_languages);
        $quiz = Quiz::find($request->input('quiz_id'));
        $quiz_fullmark = $quiz->full_mark;
        $question_grade = $request->input('grade');
        $quiz_fullmark += $question_grade;
        $quiz->update(['full_mark' => $quiz_fullmark]);
        $input_test_cases = $request->input('input_testcase');
        $output_test_cases = $request->input('output_testcase');
        $judge_options = $request->input('judge_options');
        $question->judge_options()->attach($judge_options);
        for ($i = 0; $i < count($input_test_cases); $i++) {
            TestsCase::create([
                'question_id' => $question->id,
                'input' => $input_test_cases[$i],
                'output' => $output_test_cases[$i],
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
        $problem = Question::find($id);
        $judge_options = JudgeOptions::all();
        $coding_languages = codingLanguages::all();
        $problem_judge_options = $problem->judge_options()->pluck('judge_id')->toArray();
        $problem_coding_languages = $problem->coding_languages()->pluck('language_id')->toArray();
        return view('problems.edit', compact('problem', 'id',
            'judge_options', 'coding_languages',
            'problem_judge_options', 'problem_coding_languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        $this->validate($request, [
            'question_text' => 'required',
            'grade' => 'required|min:1|',

        ]);

        if ($problem = Question::find($id)) {
            $updates = $request->all();
            $problem->fill($updates)->save();

            //Updating testcases
            $testcases = TestsCase::where('question_id', '=', $id)->get();
            foreach ($testcases as $cases) {
                $cases->delete();
            }
            $input_test_cases = $request->input('input_testcase');
            $output_test_cases = $request->input('output_testcase');
            for ($i = 0; $i < count($input_test_cases); $i++) {
                TestsCase::create([
                    'question_id' => $id,
                    'input' => $input_test_cases[$i],
                    'output' => $output_test_cases[$i],
                ]);
            }
            //Updating judge options
            $judge_options = $problem->judge_options()->pluck('judge_id')->toArray();
            $request_judge_options = $request->input('judge_options');
            $problem->judge_options()->detach($judge_options);
            $problem->judge_options()->attach($request_judge_options);
            //Updating coding languages
            $coding_languages = $problem->coding_languages()->pluck('language_id')->toArray();
            $request_coding_languages = $request->input('coding_languages');
            $problem->coding_languages()->detach($coding_languages);
            $problem->coding_languages()->attach($request_coding_languages);
            $request->session()->flash('success', 'problem has been edited successfully');
            return redirect()->back();
        } else {
            $request->session()->flash('failure', 'Error occurred while updating problem information');
            return redirect()->back();
        }

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
