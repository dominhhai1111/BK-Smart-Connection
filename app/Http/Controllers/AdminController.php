<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/admin/index');
    }

    public function showAllUsers()
    {
        $users = DB::table("user")->select()->get();
        return view('/admin/showUsers', ['users' => $users]);
    }

    public function showAllCircumstances()
    {
        $circumstances = DB::table("circumstance")->select()->get();
        return view('/admin/showCircumstances', ['circumstances' => $circumstances]);
    }

    public function showAllSolutions()
    {
        $solutions = DB::table("solution")->select()->get();
        return view('/admin/showSolutions', ['solutions' => $solutions]);
    }

    public function showActivityWords(){
        $activityDB = DB::table("activity")->get();
        $activityWords = DB::table("activity_words")->get();
        return view('/admin/showActivityWords', ['activityDB'=> $activityDB, 'activityWords' => $activityWords]);
    }

    public function addActivityWord(Request $request){
        $activityWord_name = $request->input("activityWord");
        $activity_id = $request->input("activity");
        return \redirect('/admin/showActivityWords');
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
        //
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
