<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('correct_answers');
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-read', ['only' => 'index']);
        $this->middleware('permission:role-create', ['only' => 'edit']);
        $this->middleware('permission:role-delete', ['only' => 'destroy']);
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('category');
        $security_permissions = $permissions['security'];
        $hep_permissions = $permissions['hep'];
        $lep_permissions = $permissions['lep'];
        $other_permissions = $permissions['other'];
        return view('admin.role.create', compact('security_permissions', 'hep_permissions', 'lep_permissions', 'other_permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->except(['permission', '_token']));

        foreach ($request->permission as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('role.index')->withMessage('role created');

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
        $role = Role::find($id);
        $permissions = Permission::all()->groupBy('category');
        $security_permissions = $permissions['security'];
        $hep_permissions = $permissions['hep'];
        $lep_permissions = $permissions['lep'];
        $other_permissions = $permissions['other'];
        $role_permissions = $role->perms()->pluck('id', 'id')->toArray();
        return view('admin.role.edit', compact(['role', 'role_permissions', 'security_permissions', 'hep_permissions', 'lep_permissions', 'other_permissions']));
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
        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        DB::table('permission_role')->where('role_id', $id)->delete();

        foreach ($request->permission as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('role.index')->withMessage('Role Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table("roles")->where('id', $id)->delete();
        return back()->withMessage('Role Deleted');

    }
}