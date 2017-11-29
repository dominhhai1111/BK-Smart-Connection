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
        $arr = array(array("name"=>"home", "type"=>"LOCATION", "frequency"=>"0.6"), array("name"=>"Lynk Lee", "type"=>"PERSON", "frequency"=>"0.4"));

        $json = json_encode($arr);
        $objects = json_decode($json);
        $list_existence_noun = [];
        foreach ($objects as $object){
            switch ($object->type){
                case "PERSON": $list_peron[] = $object->name;
                case "LOCATION": $list_existence_noun[] = $object->type;
                case "OTHER": $list_existence_noun[] = $object->type;
            }
        }
        $topic = $this->findTopicMusic($objects);
        $singer = $this->findSingerMusic($objects);
        $music = DB::table("music")->where("id", 1)->first();
        return var_dump($topic) . var_dump($singer) ;
    }

    public function findTopicMusic($objects){
        $topics_weight = [];
        foreach ($objects as $object){
            if ($object->type == "LOCATION" || $object->type == "OTHER"){
                $existence_in_data = DB::table("dictionary")->select("id_topic")->where("name", $object->name)->first();
                //var_dump($existence_in_data); die;
                if($existence_in_data != null){
                    if(!array_key_exists($existence_in_data->id_topic, $topics_weight)){
                        $topics_weight[$existence_in_data->id_topic] = 0;
                    }
                    $topics_weight[$existence_in_data->id_topic] += $object->frequency;
                }
            }
        }
        $topics_have_max_weight = array_keys($topics_weight);
        // Choose topic have max weight is the first in array $topics_have_max_wright
        $topic_have_max_weight = DB::table("topic")->where("id", $topics_have_max_weight[0])->first();
        return $topic_have_max_weight;
    }

    public function findSingerMusic($objects){
        foreach ($objects as $object){
            if($object->type == "PERSON"){
                $existence_in_data = DB::table("singer")->where("name", $object->name)->first();
                if($existence_in_data != null){
                    return $existence_in_data;
                }else {
                    return null;
                }
            }
        }
    }


    public function playMusic($music){
        return redirect("/public/uploads/music/".$music);
    }
}
