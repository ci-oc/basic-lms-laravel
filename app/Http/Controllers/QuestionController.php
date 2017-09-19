<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Quiz;
use App\QuestionsOption;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:create-quiz');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questions.index');
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
            $correct_options = [
                'option1' => 'Option #1',
                'option2' => 'Option #2',
                'option3' => 'Option #3',
                'option4' => 'Option #4',
                'option5' => 'Option #5'
            ];
            return view('questions.create', compact('correct_options'));
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
        $this->validate($request, [
            'quiz_id' => 'required',
            'grade' => 'required|numeric|min:0',
            'question_text' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'option5' => 'required',
            'correct' => 'required',
        ]);
        try {
            if ($request->input('grade') == null || $request->input('grade') <= 0) {
                return \redirect()->back()->with('grade-failed', '')->withInput();
            }
            $question = Question::create([
                'quiz_id' => decrypt($request->input('quiz_id')),
                'question_text' => $request->input('question_text'),
                'code_snippet' => $request->input('code_snippet'),
                'answer_explanation' => $request->input('answer_explanation'),
                'more_info_link' => $request->input('more_info_link'),
                'grade' => $request->input('grade'),
            ]);
            $quiz = Quiz::find(decrypt($request->input('quiz_id')));
            $quiz_fullmark = $quiz->full_mark;
            $question_grade = $request->input('grade');
            $quiz_fullmark += $question_grade;
            $quiz->update(['full_mark' => $quiz_fullmark]);
            foreach ($request->input() as $key => $value) {
                if (strpos($key, 'option') !== false && $value != '') {
                    $status = $request->input('correct') == $key ? 1 : 0;
                    QuestionsOption::create([
                        'question_id' => $question->id,
                        'option' => $value,
                        'correct' => $status
                    ]);
                }
            }
            return redirect()->route('questions.index');
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
            $relations = [
                'quizzes' => \App\Quiz::get()->pluck('title', 'id')->prepend('Please select', ''),
            ];

            $question = Question::findOrFail(decrypt($id));

            return view('questions.show', compact('question') + $relations);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-saving-data'));
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
            $question = Question::findOrFail(decrypt($id));
            $quiz = $question->quiz;
            if (!Quiz::isAvailable($quiz->start_date, $quiz->end_date)) {
                return view('questions.edit', compact('question'));
            } else
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'grade' => 'required|numeric|min:0',
            'question_text' => 'required',
        ]);
        try {

            $question = Question::findOrFail(decrypt($id));
            if (!Quiz::isAvailable($question->quiz->start_date, $question->quiz->end_date)) {
                $question->update($request->all());
                return redirect()->route('questions.index');
            } else {
                return redirect()->route('questions.index')->with('error', trans('module.errors.error-problem-cannot-modify'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-processing'));
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
            $quiz = Quiz::find($question->quiz->id);
            $quiz_fullmark = $quiz->full_mark;
            $question_grade = $question->grade;
            $quiz_fullmark -= $question_grade;
            $quiz->update(['full_mark' => $quiz_fullmark]);
            $question->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-saving-data'));
        }

        return redirect()->route('questions.index');
    }

    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Question::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
