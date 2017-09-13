<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailsJob;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\Http\Controllers\MailController;
use function response;
use function Sodium\compare;


class DefaultUserController extends Controller
{
    use FileUploadTrait;

    /**
     * DefaultUserController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:add-students', ['only' => 'create', 'store', 'store_single']);
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
        return view('student.create');
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
            'file' => 'required|mimes:xls,xlsx,ods',
        ]);
        $role = Role::where('name', '=', 'student')->pluck('id')->first(); //student
        if ($request->hasFile('file')) {
            $data = $this->saveFiles($request);
            if ($data != null) {
                $failed_to_create = array();
                foreach ($data as $datum) {
                    if (!array_key_exists('name', $datum) or $datum['name'] == null) {
                        return redirect('users/create')->with('name_field_failed', '');
                    } else if (!array_key_exists('email', $datum) or $datum['email'] == null) {
                        return redirect('users/create')->with('email_field_failed', '');
                    } else if (!array_key_exists('id', $datum) or $datum['email'] == null) {
                        return redirect('users/create')->with('id_field_failed', '');
                    }
                }
                foreach ($data as $datum) {
                    $non_encrypted_password = str_random(10);  //Random-auto-generating password of 10 digits.
                    $password = Hash::make($non_encrypted_password); //Encrypting this password.
                    $this->dispatch((new SendEmailsJob($non_encrypted_password, $datum['email']))->onQueue('emails'));
                    try {
                        $user = new User();
                        $user_id = $user->create([
                            'name' => $datum['name'],
                            'email' => $datum['email'],
                            'password' => $password,
                            'college_id' => $datum['id']
                        ])->attachRole($role);
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
                return redirect('users/create')->with('failed_saving_file', '');
            }
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

    public function store_single(Request $request)
    {
        $role = Role::where('name', '=', 'student')->pluck('id')->first(); //student
        $failed_to_create = array();
        try {
            $non_encrypted_password = str_random(10);  //Random-auto-generating password of 10 digits.
            $password = Hash::make($non_encrypted_password); //Encrypting this password.
            $user = new User();
            $this->dispatch((new SendEmailsJob($non_encrypted_password, $request->input('email')))->onQueue('emails'));
            $user_id = $user->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $password,
                'college_id' => $request->input('college_id'),
            ])->attachRole($role);
        } catch (\Illuminate\Database\QueryException $e) {
            $failed_to_create[] = $request->all();
        }
        return redirect('users/create')->with('data', $failed_to_create);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTemp()
    {
        $file_path = storage_path('template/template.ods');
        return Response()->download($file_path, 'template');
    }

}