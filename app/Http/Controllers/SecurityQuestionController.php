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
        $this->middleware('permission:security-questions-delete', ['only' => 'delete']);
        $this->middleware('permission:security-questions-read', ['only' => 'read']);
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


    public function index2(){
        $security_Question = SecurityQuestion::all()->toArray();
    return view('admin.security_questions.edit',compact('security_Question'));
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
        $answers = SecurityQuestion::all()->pluck('answer')->toArray();
        $question_ids = SecurityQuestion::all()->pluck('id')->toArray();
        $answer1 = $request->input('question' . $question_ids[0]);
        $answer2 = $request->input('question' . $question_ids[1]);
        $answer3 = $request->input('question' . $question_ids[2]);
        if ($answer1 != $answers[0] && $answer2 != $answers[1] && $answer3 != $answers[2]) {
             return redirect()->back()->with('failed-questions','')->withInput();
        }else{
            return view('admin.index');
        }
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
    public function edit()
    {
      return "HELLO";
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
        $question = SecurityQuestion::findOrFail($id);
        $question->delete();
        return redirect('admin.security_questions.edit');
    }

}
