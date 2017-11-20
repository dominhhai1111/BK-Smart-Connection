<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use DB;

class BKSmartConnection extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/*        DB::table("user")->insert(["name"=>"BlackFriday13"]);*/
        return view('top-page');
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
        $user = DB::table("user")->select("id", "name")->where("id", $id)->first();
        return json_encode($user);
    }

    public function getMusicUrlForUser($score, $objects)
    {
        $music = DB::table("music")->where("id", 1)->first();
        return $music->url;
    }

    public function playMusic($music){
        return redirect("/public/uploads/music/".$music);
    }
}
