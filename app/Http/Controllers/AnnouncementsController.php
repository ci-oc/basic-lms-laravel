<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Course;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AnnouncementsNotifications;


class AnnouncementsController extends Controller
{
    /**
     * AnnouncementsController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:add-announcement', ['only' => 'create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('announcements.index');
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
            $this->validate($request, [
                'announcement' => 'required',
                'ID' => 'required',
            ]);
            $course_id = decrypt($request->input('ID'));
            $data = array();
            $data['user_id'] = Auth::id();
            $data['course_id'] = $course_id;
            $data['announcement'] = $request->input('announcement');
            Announcement::create($data);
            $users = Course::find($course_id)->users()->get();
            Notification::send($users, new AnnouncementsNotifications($users->pluck('id')));
            return redirect()->back()->with('success', '');
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
        Announcement::destroy($id);
        return redirect()->back()->with('delete', '');
    }
}
