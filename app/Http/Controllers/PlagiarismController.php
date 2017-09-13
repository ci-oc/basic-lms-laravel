<?php

namespace App\Http\Controllers;

use App\PlagiarismResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlagiarismController extends Controller
{
    public function index()
    {
        $all_plagiarism_data = PlagiarismResult::all()->load('quiz', 'user_1','user_2');
        $courses_ids = Auth::user()->courses()->pluck('course_id')->toArray();
        $plagiarism_results = array();
        foreach ($all_plagiarism_data as $plagiarism_datum) {
            if (in_array(intval($plagiarism_datum->quiz->course->id), $courses_ids) && $plagiarism_datum->quiz->share_plagiarism == 1)
                $plagiarism_results[] = $plagiarism_datum;
        }
        return view('plagiarism.index', compact('plagiarism_results'));
    }
}
