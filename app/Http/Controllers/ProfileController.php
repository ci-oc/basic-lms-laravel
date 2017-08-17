<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervation\Image\Facades\Image;

class ProfileController extends Controller
{
    //

    public function index()
    {
        return view('user_profile');
    }

    public function store(Request $request)
    {
    	if ($request->hasFile('image')) {
    		Image::make($request->file('image'))->save(public_path('images/avatar/' . Auth()->email .' _profile'));

    	}
    }
}
