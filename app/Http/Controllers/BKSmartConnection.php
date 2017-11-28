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
        $user = DB::table("USER")->select("id", "name")->where("id", $id)->first();
        return json_encode($user);
    }

    public function getMusicUrlForUser($score, $objects)
    {
        $objects = json_decode($objects);
        $list_person = [];
        $list_existence = [];
        foreach ($objects as $object){
            switch ($objects->type){
                case "PERSON": $list_peron[] = $object->name;
                case "LOCATION": $list_existence[] = $object->topic;
                case "OTHER": $list_existence[] = $object->topic;
            }
        }
        $music = DB::table("MUSIC")->where("id", 1)->first();
        return $music->url;
    }

    public function findTopicMusic($list_existence){
        $topics = DB::table("TOPIC")->get();
        foreach ($topics as $topic){
            $topic_noun = DN::table("");
            foreach ($list_existence as $existenc){

            }
        }

    }

    public function playMusic($music){
        return redirect("/public/uploads/music/".$music);
    }
}
