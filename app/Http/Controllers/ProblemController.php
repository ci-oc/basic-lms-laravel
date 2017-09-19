<?php

namespace App\Http\Controllers;

use App\codingLanguages;
use App\JudgeOptions;
use App\JudgesConstraint;
use App\ProblemJudgeOptions;
use App\TestsCase;
use Illuminate\Http\Request;
use App\Question;
use App\Quiz;
use Illuminate\Support\Facades\Auth;
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
        $courses = Auth::user()->courses()->pluck('course_id')->toArray();
        $quizzes = Quiz::whereIn('course_id', $courses)->get();
        if (count($quizzes) > 0) {
            $judge_options = JudgeOptions::all();
            $coding_languages = codingLanguages::all();
            return view('problems.create', compact('judge_options', 'coding_languages'));
        } else
            return redirect()->back()->with('error', trans('module.errors.error-create-quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $judge_constraints = JudgesConstraint::get()->first()->toArray();
        $this->validate($request, [
            'ID' => 'required',
            'question_text' => 'required',
            'grade' => 'required|numeric|min:0',
            'input_format' => 'required',
            'output_format' => 'required',
            'input_testcase' => 'required|array|min:1',
            'output_testcase' => 'required|array|min:1',
            'output_testcase.*' => 'required',
            'input_testcase.*' => 'required',
            'time_limit' => 'required|numeric|min:0|max:' . $judge_constraints['max_time_limit'],
            'mem_limit' => 'required|numeric|min:0|max:' . $judge_constraints['max_mem_limit'],
            'more_info_link' => 'nullable|active_url',
            'coding_languages' => 'required'
        ]);
        try {
            $coding_languages = $request->input('coding_languages');
            $question = Question::create([
                'quiz_id' => decrypt($request->input('ID')),
                'question_text' => $request->input('question_text'),
                'code_snippet' => $request->input('code_snippet'),
                'answer_explanation' => $request->input('answer_explanation'),
                'more_info_link' => $request->input('more_info_link'),
                'input_format' => $request->input('input_format'),
                'output_format' => $request->input('output_format'),
                'time_limit' => $request->input('time_limit'),
                'mem_limit' => $request->input('mem_limit'),
                'grade' => $request->input('grade'),
            ]);
            $question->coding_languages()->attach($coding_languages);
            $quiz = Quiz::find(decrypt($request->input('ID')));
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
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', trans('module.errors.error-saving-data'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $problem = Question::findorFail(decrypt($id));
            return view('problems.show', compact('problem'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-processing'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $problem = Question::find(decrypt($id));
            if (!Quiz::isAvailable($problem->quiz->start_date, $problem->quiz->end_date)) {
                $judge_options = JudgeOptions::all();
                $coding_languages = codingLanguages::all();
                $problem_judge_options = $problem->judge_options()->pluck('judge_id')->toArray();
                $problem_coding_languages = $problem->coding_languages()->pluck('language_id')->toArray();
                return view('problems.edit', compact('problem', 'id',
                    'judge_options', 'coding_languages',
                    'problem_judge_options', 'problem_coding_languages'));
            }
            return redirect()->back()->with('error', trans('module.errors.error-problem-cannot-modify'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-processing'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $question_id)
    {
        $judge_constraints = JudgesConstraint::get()->first()->toArray();
        $this->validate($request, [
            'question_text' => 'required',
            'grade' => 'required|numeric|min:0',
            'input_format' => 'required',
            'output_format' => 'required',
            'input_testcase' => 'required|array|min:1',
            'output_testcase' => 'required|array|min:1',
            'output_testcase.*' => 'required',
            'input_testcase.*' => 'required',
            'time_limit' => 'required|numeric|min:0|max:' . $judge_constraints['max_time_limit'],
            'mem_limit' => 'required|numeric|min:0|max:' . $judge_constraints['max_mem_limit'],
            'more_info_link' => 'nullable|active_url',
            'coding_languages' => 'required'

        ]);
        try {
            $id = decrypt($question_id);
            if ($problem = Question::findorFail($id)) {
                if (!Quiz::isAvailable($problem->quiz->start_date, $problem->quiz->end_date)) {
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
                    return redirect()->route('problems.index');
                } else {
                    return redirect()->route('problems.index')->with('error', trans('module.errors.error-problem-cannot-modify'));
                }
            } else {
                $request->session()->flash('failure', 'Error occurred while updating problem information');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-saving-data'));
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
        try {
            $question = Question::findOrFail(decrypt($id));
            $quiz = $question->quiz;
            if (Quiz::hasFinished($quiz->end_date)) {
                $quiz_fullmark = $quiz->full_mark;
                $question_grade = $question->grade;
                $quiz_fullmark -= $question_grade;
                $quiz->update(['full_mark' => $quiz_fullmark]);
                $question->testcases()->delete();
                $question->delete();
                return redirect()->back();
            } else
                return redirect()->back()->with('error', trans('module.errors.error-problem-cannot-modify'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-saving-data'));
        }
    }
}
