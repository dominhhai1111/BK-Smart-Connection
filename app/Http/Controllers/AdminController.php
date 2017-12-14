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

    public function showGenre(){
        $genreDB = DB::table("genre")->get();
        return view('/admin/showGenre', ['genreDB' => $genreDB]);
    }

    public function deleteGenre($id){
        DB::table("genre")->where("id", $id)->delete();
        return \redirect('/admin/showGenre');
    }

    public function  addGenre(Request $request){
        $genre_name = $request->input("genre");
        DB::table("genre")->insert(["name" => $genre_name]);
        return \redirect('/admin/showGenre');
    }

    public function showView(){
        $viewDB = DB::table("view")->get();
        return view('/admin/showView', ['viewDB' => $viewDB]);
    }

    public function deleteView($id){
        DB::table("view")->where("id", $id)->delete();
        return \redirect('/admin/showView');
    }

    public function  addView(Request $request){
        $view_name = $request->input("view");
        DB::table("view")->insert(["name" => $view_name]);
        return \redirect('/admin/showView');
    }

    public function showFeeling(){
        $feelingDB = DB::table("feeling")->get();
        return view('/admin/showFeeling', ['feelingDB'=> $feelingDB]);
    }

    public function deleteFeeling($id){
        DB::table("feeling")->where("id", $id)->delete();
        return \redirect('/admin/showFeeling');
    }

    public function addFeeling(Request $request){
        $feeling_name = $request->input("feeling");
        DB::table("feeling")->insert(["name" => $feeling_name]);
        return \redirect('/admin/showFeeling');
    }

    public function showFeelingWords(){
        $feelingDB = DB::table("feeling")->get();
        $feelingWords = DB::table("feeling_words")->get();
        return view('/admin/showFeelingWords', ['feelingDB'=> $feelingDB, 'feelingWords' => $feelingWords]);
    }

    public function deleteFeelingWord($id){
        DB::table("feeling_words")->where("id", $id)->delete();
        return \redirect('/admin/showFeelingWords');
    }

    public function addFeelingWord(Request $request){
        $feelingWord_name = $request->input("feelingWord");
        $feeling_id = $request->input("feeling");
        DB::table("feeling_words")->insert(["name" => $feelingWord_name, "feeling_id" => $feeling_id]);
        return \redirect('/admin/showFeelingWords');
    }

    public function showSongs(){
        $songDB = DB::table("song")->get();
        $singerDB = DB::table("singer")->get();
        $genreDB = DB::table("genre")->get();
        return view('/admin/showSongs', ["songDB" => $songDB, 'singerDB' => $singerDB, 'genreDB' => $genreDB]);
    }

    public function addSong(Request $request){
        $song_name = $request->input("song");
        $singer_id = $request->input("singer");
        $genre_id = $request->input("genre");
        $url = $request->input("url");
        DB::table("song")->insert(["name" => $song_name, "singer_id" => $singer_id, "genre_id" => $genre_id ,"url" => $url]);
        return \redirect('admin/showSongs');
    }

    public function deleteSong($id){
        DB::table("song")->where("id", $id)->delete();
        return \redirect('admin/showSongs');
    }

    public function showSingers(){
        $singerDB = DB::table("singer")->get();
        return view('/admin/showSingers', ['singerDB' => $singerDB]);
    }

    public function addSinger(Request $request){
        $singer_name = $request->input("singer");
        DB::table("singer")->insert(["name" => $singer_name]);
        return \redirect('admin/showSingers');
    }

    public function deleteSinger($id){
        DB::table("singer")->where("id", $id)->delete();
        return \redirect('admin/showSingers');
    }

    public function showAlbum($id){

    }
}
