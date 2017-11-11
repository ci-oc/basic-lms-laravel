<?php

namespace App\Http\Controllers;

use App\UsersCourses;
use Illuminate\Http\Request;
use App\Course;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Material;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-course|join-course', ['only' => ['index']]);
        $this->middleware('permission:create-course', ['only' => ['create', 'store']]);
        $this->middleware('permission:drop-course', ['only' => ['destroy']]);
        $this->middleware('permission:edit-course', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = ['#4CAF50', '#2196F3', '#ff9800', '#f44336', '#e7e7e7'];
        return view('instructor.courses.index', compact('colors'));
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
    public function store(Request $request)
    {

        $this->validate($request, [
            'access_code' => 'required|min:5|unique:courses',
            'title' => 'required|max:100|min:5|',
            'description' => 'required|min:5|',
            'material.*' => 'max:2048'
        ]);
        try {
            $courses = $request->all();
            $instructors = explode(',', $request->input('assistant_professor'));
            $user_id = Auth::id();
            $failed_instructors = array();
            $success_instructors = array();
            $success_instructors[0] = $user_id;
            if (!$instructors[0] == null) {
                foreach ($instructors as $instructor) {
                    $user = User::where('email', '=', $instructor)->pluck('id');
                    if (count($user) > 0 && $user[0] != $user_id) {
                        $success_instructors[] = $user[0];
                    } else {
                        $failed_instructors[] = $instructor;
                    }
                }
            }
            $course = Course::create($courses);
            $course->users()->attach($success_instructors);
            if (count($request->allFiles()) > 0) {

                foreach (Input::file("material") as $material) {
                    $path = Storage::put('materials', $material);
                    $course_id = $course->id;
                    Material::create([
                        'course_id' => $course_id,
                        'material_path' => $path,
                        'material_name' => $material->getClientOriginalName(),
                    ]);
                }
            }
            if ($failed_instructors == null)
                return redirect()->route('courses.index')->with('success', '');
            else
                return redirect()->back()->with('failed_instructors', $failed_instructors);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed_to_save', trans('module.errors.error-saving-data'));
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
        try {
            $relation = UsersCourses::all()->load('user')->where('course_id', '=', decrypt($id));
            $assistant_professors = array();
            $course = Course::findorFail(decrypt($id));
            $material_relation = Material::with('course')->where('course_id', '=', decrypt($id))->get()->toArray();
            foreach ($relation as $relation_user) {
                if ($relation_user->user->college_id == null)
                    $assistant_professors[] = $relation_user->user;
            }
            return view('instructor.courses.view', compact('course', 'assistant_professors', 'material_relation'));
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

        try {
            $course = Course::findOrFail(decrypt($id));
            foreach ($course->users as $user) {
                if ($user->id == Auth::id())
                    return view('instructor.courses.edit', compact('course'));
            }
            return redirect()->back()->with('cannot_edit', trans('module.errors.error-not-allowed-to-modify-course'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error_processing', trans('module.errors.error-processing'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required|max:100|min:5|',
            'description' => 'required|min:5|',
        ]);
        try {
            $course_id = decrypt(Input::get('id'));
            $course = Course::findOrFail($course_id);
            $failed_instructors = array();
            $instructors = explode(',', $request->input('assistant_professor'));
            if ($request->input('title') != null) {
                $course->title = $request->input('title');
            }
            if ($request->input('assistant_professor') != null) {
                foreach ($instructors as $instructor) {
                    $user = User::where('email', '=', $instructor)->pluck('id')->first();
                    if (!$course->users->contains($user) && $user != null) {
                        $course->users()->attach($user);
                    } else
                        $failed_instructors[] = $instructor;
                }
            }
            if ($request->input('description') != null) {
                $course->description = $request->input('description');
            }
            if (count($request->allFiles()) > 0) {

                foreach (Input::file("material") as $material) {
                    $path = Storage::put('materials', $material);
                    $course_id = $course->id;
                    Material::create([
                        'course_id' => $course_id,
                        'material_path' => $path,
                        'material_name' => $material->getClientOriginalName(),
                    ]);
                }
            }
            $course->update();
            return redirect()->back()
                ->with('update-success', '')
                ->with('failed_instructors', $failed_instructors);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed_to_save', trans('module.errors.error-saving-data'));
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
            $course = Course::findOrFail(decrypt($id));
            $course->quizzes()->delete();
            $course->delete();
            return Redirect::route('courses.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-processing'));
        }
    }

    public function destroy_material($id)
    {
        try {
            $storage_path = storage_path();
            $material = Material::findorFail(decrypt($id));
            unlink($storage_path . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $material->material_path);
            $material->delete();
            return redirect()->back()->with('update-success', '');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', trans('module.errors.error-processing'));
        }
    }
}