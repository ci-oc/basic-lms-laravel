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
        $correct_options = [
            'option1' => 'Option #1',
            'option2' => 'Option #2',
            'option3' => 'Option #3',
            'option4' => 'Option #4',
            'option5' => 'Option #5'
        ];
        return view('questions.create', compact('correct_options'));
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
            'option*' => 'required',
            'correct' => 'required',
        ]);
        if ($request->input('grade') == null || $request->input('grade') <= 0) {
            return \redirect()->back()->with('grade-failed', '')->withInput();
        }
        $question = Question::create($request->all());
        $quiz = Quiz::find($request->input('quiz_id'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'quizzes' => \App\Quiz::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $question = Question::findOrFail($id);

        return view('questions.show', compact('question') + $relations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('questions.edit', compact('question'));

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
        $question = Question::findOrFail($id);
        $question->update($request->all());
        return redirect()->route('questions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

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
