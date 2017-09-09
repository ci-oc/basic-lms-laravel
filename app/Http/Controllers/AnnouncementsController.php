<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UsersCourses;
use Illuminate\Support\Facades\Crypt;

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
            $data = array();
            $data['user_id'] = Auth::id();
            $data['course_id'] = decrypt($request->input('ID'));
            $data['announcement'] = $request->input('announcement');
            Announcement::create($data);
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
