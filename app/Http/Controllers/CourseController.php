<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CourseController extends Controller
{
    /**
     * CourseController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:instructor', ['only' => ['create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        return view('instructor.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instructor.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function generateFileName()
    {
        $time = Carbon::now();
        return (string)$time->toDateTimeString();
    }

    public function store(Request $request)
    {
        $file = $this->generateFileName() . '.xlsx';
        $request->file('file')->storeAs('images', $file);
        $data = Excel::load('storage/app/images/' . $file)->get();
        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $insert[] = ['id' => $value->id, 'name' => $value->name, 'email' => $value->email];
            }
            print_r($insert);
        }
        $failed_to_create = array();
        foreach ($insert as $insertion) {
            $non_encrypted_password = str_random(10);
            $password = Hash::make($non_encrypted_password);
            try {
                User::create([
                    'name' => $insertion['name'],
                    'email' => $insertion['email'],
                    'password' => $password,
                    'college_id' => $insertion['id']
                ]);

            } catch (\Illuminate\Database\QueryException $e) {
                $failed_to_create[] = [
                    'name' => $insertion['name'],
                    'email' => $insertion['email'],
                    'college_id' => $insertion['id']
                ];
            }
        }
        $courses = $request->all();
        $user = User::find(Auth::id());
        $access_code_exists = Course::where('access_code', '=', Input::get('access_code'))->first();
        if ($access_code_exists === null) {
            Course::create($courses)->instructors()->save($user);
            return redirect()->route('courses.index');
        } else
            return redirect()->route('courses.create')->withInput();
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
        $course = Course::findOrFail($id);
        $course->delete();
        return Redirect::route('courses.index');
    }
}
