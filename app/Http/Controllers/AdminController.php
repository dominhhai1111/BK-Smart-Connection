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
        $id_activity = $request->input("activity");
        DB::table("activity_words")->insert(["name" => $activityWord_name, "id_activity" => $id_activity]);
        return \redirect('/admin/showActivityWords');
    }

    public function deleteActivityWord($id){
        DB::table("activity_words")->where("id", $id)->delete();
        return \redirect('/admin/showActivityWords');
    }

    public function showActivity(){
        $activityDB = DB::table("activity")->get();
        return view('/admin/showActivity', ['activityDB'=> $activityDB]);
    }

    public function deleteActivity(){

    }

    public function addActivity(Request $request){
        $activity_name = $request->input("activity");
        DB::table("activity")->insert(["name" => $activity_name]);
        return \redirect('/admin/showActivity');
    }

    public function showGenre(){
        $activityDB = DB::table("activity")->get();
        $activityWords = DB::table("activity_words")->get();
        return view('/admin/showActivityWords', ['activityDB'=> $activityDB, 'activityWords' => $activityWords]);
    }

    public function  deleteGenre(){

    }

    public function  addGenre(){

    }

    public function showGenreWords(){
        $activityDB = DB::table("activity")->get();
        $activityWords = DB::table("activity_words")->get();
        return view('/admin/showActivityWords', ['activityDB'=> $activityDB, 'activityWords' => $activityWords]);
    }

    public function deleteGenreWords(){

    }

    public function  addGenreWords(){

    }

    public function showFeeling(){
        $feelingDB = DB::table("feeling")->get();
        return view('/admin/showFeeling', ['feelingDB'=> $feelingDB]);
    }

    public function  deleteFeeling(){

    }

    public function  addFeeling(Request $request){
        $feeling_name = $request->input("feeling");
        DB::table("feeling")->insert(["name" => $feeling_name]);
        return \redirect('/admin/showFeeling');
    }

    public function showFeelingWords(){
        $feelingDB = DB::table("feeling")->get();
        $feelingWords = DB::table("feeling_words")->get();
        return view('/admin/showFeelingWords', ['feelingDB'=> $feelingDB, 'feelingWords' => $feelingWords]);
    }

    public function  deleteFeelingWords(){

    }

    public function  addFeelingWords(){

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
