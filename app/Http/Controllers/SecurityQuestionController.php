<?php

namespace App\Http\Controllers;

use App\SecurityQuestion;
use Illuminate\Http\Request;

class SecurityQuestionController extends Controller
{
    /**
     * SecurityQuestionController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:security-questions-create', ['only' => 'create']);
        $this->middleware('permission:security-questions-edit', ['only' => 'edit']);
        $this->middleware('permission:security-questions-delete', ['only' => 'destroy']);
        $this->middleware('permission:security-questions-read', ['only' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $security_questions = SecurityQuestion::all()->toArray();
        return view('admin.security_questions.index', compact('security_questions'));
    }


    public function index2()
    {
        $security_Question = SecurityQuestion::all()->toArray();
        return view('admin.security_questions.show', compact('security_Question'));
    }

    public function index3()
    {
        return view('admin.security_questions.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answers = SecurityQuestion::all()->pluck('answer')->toArray();
        $question_ids = SecurityQuestion::all()->pluck('id')->toArray();
        for ($i = 0; $i < count($answers); $i++) {
            $answer = $request->input('question' . $question_ids[$i]);
            if ($answer != $answers[$i]) {
                return redirect()->back()->with('failed-questions', '')->withInput();
            }
        }
        $request->session()->put('answered-correctly', 'true');
        $url = \App\Url::pluck('url')->first();
        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = SecurityQuestion::where('id', '=', $id)->get()->toArray();
        return view('admin.security_questions.edit', compact('question'));
    }

    public function store_question(Request $request)
    {
        $question = $request->all();
        SecurityQuestion::create($question);
        return redirect()->back()->with('success-adding', '');
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
        $question = SecurityQuestion::findOrFail($id);
        $question->question_text = $request->input('question_text');
        $question->answer = $request->input('answer');
        $question->save();
        return back()->with('success-editing', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo $id;
        $question = SecurityQuestion::findOrFail($id);
        $question->delete();
        return redirect()->back()->with('success-deletion', '');
    }

}
