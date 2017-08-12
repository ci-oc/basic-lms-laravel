<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\FileUploadTrait;

class DefaultUserController extends Controller
{
    use FileUploadTrait;

    /**
     * DefaultUserController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:instructor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('users.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('file')) {
            $data = $this->saveFiles($request);
            if ($data !== 0) {
                $failed_to_create = array();
                foreach ($data as $datum) {
                    $non_encrypted_password = str_random(10);  //Random-auto-generating password of 10 digits.
                    $password = Hash::make($non_encrypted_password); //Encrypting this password.
                    try {
                        $user = new User();
                        $user->create([
                            'name' => $datum['name'],
                            'email' => $datum['email'],
                            'password' => $password,
                            'college_id' => $datum['id']
                        ]);

                    } catch (\Illuminate\Database\QueryException $e) {
                        $failed_to_create[] = [
                            'name' => $datum['name'],
                            'email' => $datum['email'],
                            'college_id' => $datum['id']
                        ];
                    }
                }
                return redirect('users/create')->with('data', $failed_to_create);
            } else {
                return redirect('users/create')->with('failed_saving_file');
            }
        } else {
            $failed_to_create = array();
            try {
                $non_encrypted_password = str_random(10);  //Random-auto-generating password of 10 digits.
                $password = Hash::make($non_encrypted_password); //Encrypting this password.
                $user = new User();
                $user->create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $password,
                    'college_id' => $request->input('college_id'),
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                $failed_to_create[] = [$request->all()];
            }
            return redirect('users/create')->with('data', $failed_to_create);

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
