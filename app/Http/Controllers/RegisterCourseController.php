<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
class RegisterCourseController extends Controller
{
    /**
     * RegisterCourseController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:student');
    }

    /**
     * Display a listing of the resource.'
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $available_courses = Course::all();
        $colors = ['#4CAF50', '#2196F3', '#ff9800', '#f44336', '#e7e7e7'];
        return view('student.courses.enroll',compact('available_courses','colors'));
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
