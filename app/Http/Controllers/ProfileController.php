<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:edit-profile', ['only' => ['update', 'update_image']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_status = null;
        if (Auth::user()->cf_handle != null) {
            $url_user = 'http://codeforces.com/api/user.status?handle=' . Auth::user()->cf_handle . '&from=1';
            $curl_user = curl_init($url_user);
            curl_setopt($curl_user, CURLOPT_RETURNTRANSFER, $url_user);
            $user_status = json_decode(curl_exec($curl_user));
            @curl_close($curl_user);
        }
        return view('user_profile', compact('user', 'user_status'));
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
    public function update(Request $request)
    {
        //
        $user = Auth::user();
        if ($request->has('cf_handle')) {
            $user->cf_handle = $request->input('cf_handle');
            $user->save();
        }
        if ($request->has('password')) {
            $this->validate($request, [
                'old' => 'required|min:6',
                'password' => 'required|string|min:6|confirmed',
            ]);
            $hashedPassword = $user->password;
            if (Hash::check($request->old, $hashedPassword)) {  //if the old password is correct:
                //Change the password
                $user->fill(['password' => Hash::make($request->password)])->save();
                $request->session()->flash('success', 'Your password has been changed.');
                return back();
            }
            $request->session()->flash('failure', 'Your password has not been changed. It may be your old password is not correct');
        }
        return back();
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

    public function update_image(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpg,jpeg,png',
        ]);
        $user = Auth::user();
        $avatar = $request->file('avatar');
        $file_name = time() . '_' . Auth::id() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(250, 250)->save(public_path('/images/avatar/' . $file_name));
        try {
            if ($user->avatar != '/images/avatar/default_avatar.png')
                unlink(public_path($user->avatar));
        } catch (\Exception $e) {
        }
        $user->avatar = 'images/avatar/' . $file_name;
        $user->save();
        return back();

    }
}
