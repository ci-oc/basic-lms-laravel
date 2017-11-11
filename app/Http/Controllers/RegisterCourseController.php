<?php

namespace App\Http\Controllers;

use App\UsersCourses;
use Illuminate\Http\Request;
use App\Course;
use Illuminate\Support\Facades\Auth;
use App\User;

class RegisterCourseController extends Controller
{
    /**
     * RegisterCourseController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:create-course|join-course|view-course', ['only' => 'index']);
        $this->middleware('permission:join-course', ['only' => 'store']);
    }

    /**
     * Display a listing of the resource.'
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrolled_courses = Course::select('id')->whereHas('users', function ($q) {
            return $q->where('user_id', '=', Auth::id());
        })->pluck('id')->toArray();
        $available_courses = Course::all()->load('users')->whereNotIn('id', $enrolled_courses);
        $colors = ['#4CAF50', '#2196F3', '#ff9800', '#f44336', '#e7e7e7'];
        return view('student.courses.enroll', compact('available_courses', 'colors'));
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
        $this->validate($request, [
            'course_id' => 'required',
        ]);
        try {
            $course = Course::find(decrypt($request->input('course_id')));
            if ($request->input('access_code') == $course->access_code) {
                $user = Auth::id();
                UsersCourses::create(['user_id' => $user,
                    'course_id' => decrypt($request->input('course_id'))]);
                return redirect()->route('courses.index');
            } else {
                return redirect()->back()->with('invalid_access_code', '');
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
