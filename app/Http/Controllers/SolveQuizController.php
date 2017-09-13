<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\FileUploadTrait;
use App\Jobs\RemarkQuizJob;
use App\UsersProblemAnswer;
use App\UsersTestCaseAnswer;
use Illuminate\Http\Request;
use App\UsersQuiz;
use Illuminate\Support\Facades\Auth;
use App\Quiz;

class SolveQuizController extends Controller
{
    use FileUploadTrait;

    /**
     * SolveQuizController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:solve-quiz', ['only' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $test_id = decrypt($request->input('quiz_id'));
            $quiz = Quiz::findorFail($test_id);
            $test = UsersQuiz::where([
                ['user_id', '=', Auth::id()],
                ['quiz_id', '=', $test_id,]
            ])->get()->first();
            $duration_finished = false;
            $time_finished = false;
            if ($quiz->duration != null) {
                $duration = Quiz::calculateDuration($quiz->duration, $test->updated_at);
                $duration_finished = Quiz::hasFinished($duration);
            } else {
                $time_finished = Quiz::hasFinished($quiz->end_date);
            }
            if (!$duration_finished && !$time_finished) {

                $this->dispatch((new RemarkQuizJob($request->all(), $test, $test_id, Auth::id()))->onQueue('remark'));
                return redirect()->route('results.index');
            } else {
                $test->update(['processing_status' => 'OK']);
                return redirect()->route('results.index')->with('failed', trans('module.errors.error-time-finished'));
            }
        } catch (\Exception $e) {
            return redirect()->route('quizzes.index');
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
