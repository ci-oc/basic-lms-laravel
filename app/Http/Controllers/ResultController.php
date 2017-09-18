<?php

namespace App\Http\Controllers;

use App\PlagiarismResult;
use App\UsersAnswer;
use App\UsersProblemAnswer;
use App\UsersQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quiz;
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
        try {
            $quiz_result = UsersQuiz::findorFail(decrypt($id))->load('user', 'quiz');
            if ($quiz_result->user->id == Auth::id() or Auth::user()->can('show-quiz-results')) {
                $can_view = false;
                if ($quiz_result->quiz->results_details_w_respect_t_time) {
                    $can_view = !Quiz::hasFinished($quiz_result->quiz->end_date);
                }
                if (!$can_view) {
                    if ($quiz_result->processing_status == "OK") {
                        $questions_results = UsersAnswer::where([
                            ['user_id', '=', $quiz_result->user->id],
                            ['quiz_id', '=', $quiz_result->quiz_id]
                        ])->get();
                        $problems_results = UsersProblemAnswer::where([
                            ['user_id', '=', $quiz_result->user->id],
                            ['quiz_id', '=', $quiz_result->quiz_id]
                        ])->get();
                        $problems_results->load('solvedTestCases');
                        $plagiarism_data = PlagiarismResult::where('user_1_id', '=', Auth::id())->orWhere('user_2_id', '=', Auth::id())->get();
                        return view('results.show', compact('quiz_result', 'questions_results', 'problems_results', 'plagiarism_data'));
                    } else {
                        return redirect()->back()->with('pending', '');
                    }
                } else
                    return redirect()->back()->with('error',trans('module.errors.error-cannot-vew-result'));
            } else {
                abort(404);
            }
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
