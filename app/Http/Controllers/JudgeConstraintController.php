<?php

namespace App\Http\Controllers;

use App\JudgesConstraint;
use Illuminate\Http\Request;

class JudgeConstraintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.online_judge_configuration.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $max_memory_limit = $request->input('memory_limit');
        $max_time_limit = $request->input('time_limit');
        if($max_memory_limit <= 0){
            return redirect()->back()->with('error-memory-limit','');
        }else if($max_time_limit <= 0){
            return redirect()->back()->with('error-time-limit','');
        }
        $data = JudgesConstraint::firstOrNew(array('id' =>1));
        //$existing_data = JudgesConstraint::where('id','=',1);
        $data->max_mem_limit = $request->input('memory_limit');
        $data->max_time_limit = $request->input('time_limit');
        if($data->save()){
            return redirect()->back()->with('data-success','');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
