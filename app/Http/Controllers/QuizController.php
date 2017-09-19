<?php

namespace App\Http\Controllers;

use App\UsersQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quiz;
use App\Question;
use App\UsersProblemAnswer;
use Carbon\Carbon;

class QuizController extends Controller
{
    /**
     * QuizController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:create-quiz', ['only' => ['create']]);
        $this->middleware('permission:create-quiz|solve-quiz', ['only' => ['index']]);
        $this->middleware('permission:edit-quiz', ['only' => ['edit', 'update']]);
        $this->middleware('permission:show-quiz-statistics', ['only' => ['chart']]);
        $this->middleware('permission:show-quiz-results', ['only' => ['results']]);
        $this->middleware('permission:delete-quiz', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solved_quizzes = UsersQuiz::with('quiz')->where('user_id', '=', Auth::id())->get();
        return view('quiz.index', compact('solved_quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (count(Auth::user()->courses) > 0)
            return view('quiz.create');
        else
            return redirect()->back()->with('courses_0', '');
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
            'course_title' => 'required',
            'title' => 'required',
            'description' => 'required',
            'duration' => 'nullable|date_format:"H:i:s',
            'start_date' => 'date_format:Y-m-d H:i:s|after:now',
            'end_date' => 'date_format:Y-m-d H:i:s|after:now',
            'solve_many' => 'numeric|min:0|max:1',
            'activate_plagiarism' => 'numeric|min:0|max:1',
            'share_results' => 'numeric|min:0|max:1',
            'share_plagiarism' => 'numeric|min:0|max:1',
            'results_details_w_respect_t_time' => 'numeric|min:0|max:1',
            'plagiarism_percentage' => 'nullable|numeric|min:0|max:100',
        ]);
        try {
            $time_error_count = 0;
            $date_error_count = 0;
            $start_date_explode = explode(' ', $request->input('start_date'));
            $end_date_explode = explode(' ', $request->input('end_date'));
            $start_date_temp = $start_date_explode[0];
            $end_date_temp = $end_date_explode[0];
            $start_date = explode('-', $start_date_temp);
            $end_date = explode('-', $end_date_temp);
            for ($i = 0; $i < count($start_date); $i++) {
                if ($end_date[$i] <= $start_date[$i]) {
                    $date_error_count += 1;
                }
            }
            if ($date_error_count == 3) { // data = data then check for time
                $start_time_explode = explode(' ', $request->input('start_date'));
                $end_time_explode = explode(' ', $request->input('end_date'));
                $start_time_temp = $start_time_explode[1];
                $end_time_temp = $end_time_explode[1];
                $start_time = explode(':', $start_time_temp);
                $end_time = explode(':', $end_time_temp);
                for ($i = 0; $i < count($start_time); $i++) {
                    if ($end_time[$i] <= $start_time[$i]) {
                        $time_error_count += 1;
                    }
                }
                if ((($end_time[2] - $start_time[2]) == 1) && ($time_error_count != 3)) {
                    return redirect()->back()->with('failed-quiz-time-gap', '')->withInput();
                }
            }
            if ($time_error_count == 3) {
                return redirect()->back()->with('failed-quiz-time', '')->withInput();
            } else {
                Quiz::create([
                    'course_id' => decrypt($request->input('course_title')),
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'duration' => $request->input('duration'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'solve_many' => $request->input('solve_many'),
                    'activate_plagiarism' => $request->input('activate_plagiarism'),
                    'share_results' => $request->input('share_results'),
                    'plagiarism_percentage' => $request->input('plagiarism_percentage'),
                    'share_plagiarism' => $request->input('share_plagiarism'),
                    'results_details_w_respect_t_time' => $request->input('results_details_w_respect_t_time'),
                ]);
                return redirect()->route('quizzes.index')->with('success-creation', '');
            }
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
    public function show($quiz_id)
    {
        try {
            $id = decrypt($quiz_id);
            $quiz = Quiz::findorFail($id)->load('questions');
            if (!Quiz::hasFinished($quiz->end_date) && Quiz::isAvailable($quiz->start_date, $quiz->end_date)) {
                $all_type_questions[] = $quiz->questions;
                $quiz_questions = Question::separateQuestionTypes($all_type_questions, 'MCQ');
                $quiz_problems = Question::separateQuestionTypes($all_type_questions, 'JUDGE');
                $solve_many = $quiz->solve_many;
                $grade = UsersQuiz::where([['user_id', '=', Auth::id()],
                    ['quiz_id', '=', $id]])->pluck('grade')->toArray();
                if ($grade == null || $solve_many) {
                    if (count($quiz->questions) > 0) {
                        $result = 0;
                        $possible_result = UsersQuiz::where([['user_id', '=', Auth::id()], ['quiz_id', '=', $id]])->pluck('grade')->first();
                        if ($possible_result != null)
                            $result = $possible_result;
                        $solved_quiz = UsersQuiz::updateOrCreate([
                            'user_id' => Auth::id(),
                            'quiz_id' => $id,
                        ], [
                            'user_id' => Auth::id(),
                            'quiz_id' => $id,
                            'grade' => $result,
                            'processing_status' => 'PD',
                            'updated_at' => Carbon::now()
                        ]);
                        $return_duration = null;
                        if ($quiz->duration != null) {
                            $duration = Quiz::calculateDuration($quiz->duration, $solved_quiz->updated_at);
                            $duration_modified = explode(' ', $duration);
                            $return_duration = $duration_modified[0] . 'T' . $duration_modified[1];
                        }
                        return view('quiz.show', compact('id', 'solve_many', 'quiz_questions', 'quiz_problems', 'quiz', 'return_duration'));
                    } else
                        return redirect()->back()->with('0_questions', '');
                }
                return redirect()->back()->with('done_already', '');
            }
            return redirect()->back()->with('not_available', '');
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
    public function edit($quiz_id)
    {
        try {
            $id = decrypt($quiz_id);
            $quiz = Quiz::findorFail($id);
            if (!Quiz::isAvailable($quiz->start_date, $quiz->end_date))
                return view('quiz.edit', compact('quiz', 'id'));
            return redirect()->back()->with('cannot_modify', trans('module.errors.error-quiz-cannot-modify'));
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
            'title' => 'required',
            'description' => 'required',
            'duration' => 'nullable|date_format:"H:i:s',
            'start_date' => 'date_format:Y-m-d H:i:s|after:now',
            'end_date' => 'date_format:Y-m-d H:i:s|after:now',
            'solve_many' => 'numeric|min:0|max:1',
            'activate_plagiarism' => 'numeric|min:0|max:1',
            'share_results' => 'numeric|min:0|max:1',
            'share_plagiarism' => 'numeric|min:0|max:1',
            'results_details_w_respect_t_time' => 'numeric|min:0|max:1',
            'plagiarism_percentage' => 'nullable|numeric|min:0|max:100',
        ]);
        try {
            if ($quiz = Quiz::findOrFail(decrypt($id))) {
                if (!Quiz::isAvailable($quiz->start_date, $quiz->end_date)) {
                    $updates = $request->all();
                    $updates['checked_for_plagiarism'] = 0;
                    if ($quiz->fill($updates)->save()) {
                        $request->session()->flash('success', trans('module.success.success-editing-quiz'));
                        return redirect()->route('quizzes.index');
                    } else {
                        $request->session()->flash('failure', trans('module.errors.error-processing'));
                        return redirect()->back();
                    }
                } else {
                    $request->session()->flash('failure', 'Error occurred while updating quiz information');
                    return redirect()->back();
                }
            } else
                return redirect()->route('quizzes.index')->with('cannot_modify', trans('module.errors.error-quiz-cannot-modify'));
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
            $quiz = Quiz::findOrFail(decrypt($id));
            $quiz->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-processing'));
        }

    }

    public function chart($quiz_id)
    {
        try {
            $id = decrypt($quiz_id);
            $solved_quiz = UsersQuiz::with('user', 'quiz')->where('quiz_id', '=', $id)->get();
            if ($solved_quiz->first() != null) {
                $chart_data[] = ['Name', 'Grade'];
                $full_mark_count = 0;
                $failed_count = 0;
                foreach ($solved_quiz as $quiz) {
                    $chart_data[] = [$quiz->user->name, $quiz->grade];
                    //for count of full mark
                    if ($quiz->grade == $quiz->quiz->full_mark)
                        $full_mark_count++;

                    //for count of failed
                    if ($quiz->grade < (($quiz->quiz->full_mark) / 2))
                        $failed_count++;
                }
                $problems = Question::where([['quiz_id', '=', $id],
                    ['input_format', '!=', null]])->get();
                $problem_return = new Question();
                $Percentage = 100;
                foreach ($problems as $problem) {
                    $sum_of_students_grades = UsersProblemAnswer::where('problem_id', '=', $problem->id)->sum('grade');
                    $count_of_students = UsersProblemAnswer::where('problem_id', '=', $problem->id)->count();
                    $Grade = (($sum_of_students_grades) / ($problem->grade * $count_of_students)) * 100;
                    if ($Grade <= $Percentage) {
                        $Percentage = $Grade;
                        $problem_return = $problem;
                    }
                }
                return view('quiz.chart')
                    ->with('chart_data', json_encode($chart_data))
                    ->with('minimum_problem', $problem_return)
                    ->with('minimum_problem_percentage', $Percentage)
                    ->with('full_mark_count', $full_mark_count)
                    ->with('failed_count', $failed_count);
            } else
                return redirect()->back()->with('none-solved', '');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-processing'));
        }
    }

    public function results($id)
    {
        try {
            $submissions = UsersQuiz::with('user', 'quiz')->where('quiz_id', '=', decrypt($id))->get();
            return view('quiz.submissions.index', compact('submissions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-processing'));
        }

    }
}
