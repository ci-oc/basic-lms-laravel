<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserController extends Controller
{
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
            $file = $this->generateFileName() . '.xlsx';
            $request->file('file')->storeAs('images', $file);
            $data = Excel::load('storage/app/images/' . $file)->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $data[] = ['id' => $value->id, 'name' => $value->name, 'email' => $value->email];
                }
            }
            $failed_to_create = array();
            foreach ($data as $datum) {
                $non_encrypted_password = str_random(10);  //Random-auto-generating password of 10 digits.
                $password = Hash::make($non_encrypted_password); //Encrypting this password.
                try {
                    User::create([
                        'name' => $datum['name'],
                        'email' => $datum['email'],
                        'password' => $password,
                        'college_id' => $datum['id']
                    ]);

                } catch (\Illuminate\Database\QueryException $e) {
//                    $failed_to_create[] = [
//                        'name' => $datum['name'],
//                        'email' => $datum['email'],
//                        'college_id' => $datum['id']
//                    ];
//                    return $failed_to_create;
                    return $e;
                }
            }
            return redirect()->route('users.create');
        } else {
            $failed_to_create = array();
            try {
                $non_encrypted_password = str_random(10);  //Random-auto-generating password of 10 digits.
                $password = Hash::make($non_encrypted_password); //Encrypting this password.
                User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $password,
                    'college_id' => $request->input('college_id'),
                ]);
                return redirect()->route('users.create');
            } catch (\Illuminate\Database\QueryException $e) {
                $failed_to_create[] = [$request->all()];
                return $failed_to_create;
            }
        }
    }

    public function generateFileName()
    {
        $time = Carbon::now();
        return (string)$time->toDateTimeString();
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
