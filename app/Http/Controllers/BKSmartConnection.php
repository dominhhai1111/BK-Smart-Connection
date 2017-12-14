<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use DB;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;

class Object {
    private $name;
    private $type;
    private $frequency;
}

class ReObject {
    private $score;
    private $message;
}

class BKSmartConnection extends Controller
{
    public function test($object1, $object2){
        return var_dump($object1);
    }
    // du lieu test
    public function setDataTest(){
        $json = '[
            {
                "frequenCy":0.31585333,"name":"Adele","type":"PERSON"
            },
            {
                "frequency":0.21542777,"name": "SONG","type":"WORK_OF_ART"
            },
            {
                "frequency":0.21542777,"name": "SONG","type":"WORK_OF_ART"
            }
        ]';

        $objects = json_decode($json);
        return $objects;
    }

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
        $id_topic_have_max_weight = array_search(max($topics_weight),$topics_weight);
        // Choose topic have max weight is the first in array $topics_have_max_wright
        $topic_have_max_weight = DB::table("topic")->where("id", $id_topic_have_max_weight)->first();
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

    public function getResult($message, $score, $objects){
        //TODO
        $data = [];
        if ($this->rule1($data)){
            return $this->rule1($data);
        }elseif ($this->rule2($data)){
            return $this->rule2($data);
        }elseif ($this->rule3($data)){
            return $this->rule3($data);
        }elseif ($this->rule4($data)){
            return $this->rule4($data);
        }
        return null;
    }

    // singer
    public function rule1($objects){
        $arrSingerName = [];
        $objects = $this->setDataTest();
        foreach ($objects as $object){
            if ($object->type == "PERSON"){
                $arrSingerName[] = $object->name;
            }
        }
        $str_singers = $this->convertMessage($arrSingerName);
        $list_of_song = DB::select(
            "SELECT song.name as song_name, singer.name as singer_name
            FROM song, singer
            WHERE song.singer_id = singer.id AND
            singer.name IN $str_singers"
        );
        return var_dump($list_of_song);
    }

    // Genre
    public function rule2($message){
        $convertMessage = $this->convertMessage($this->explodeMessage($message));
        $list_of_song = DB::select(
            "SELECT song.name as song_name, genre.name as genre_name
            FROM song, genre, song_genre
            WHERE genre.id = song.genre_id AND 
            genre.name IN $convertMessage"
        );
        return var_dump($list_of_song);
    }

    // View
    public function rule3($view){
        $arrViewName = [];
        $objects = $this->setDataTest();
        foreach ($objects as $object){
            if ($object->type == "LOCATION"){
                $arrViewName[] = $object->name;
            }
        }
        $str_views = $this->convertMessage($arrViewName);
        $list_of_song = DB::select(
            "SELECT song.name as song_name, singer.name as singer_name, view.name as view_name
            FROM song, singer, view, song_view
            WHERE song.singer_id = singer.id AND
            song.id = song_view.song_id AND
            view.id = song_view.view_id AND
            view.name IN $str_views"
        );
        return var_dump($list_of_song);
    }

    // Feeling
    public function rule4($message){
        $convertMessage = $this->convertMessage($this->explodeMessage($message));
        $list_of_song = DB::select(
            "SELECT song.name as song_name, feeling.name as feeling_name
            FROM song, feeling, song_feeling, feeling_words
            WHERE song.id = song_feeling.song_id AND 
            feeling.id = song_feeling.feeling_id AND 
            feeling.id = feeling_words.feeling_id AND 
            feeling_words.name IN $convertMessage"
        );
        return var_dump($list_of_song);
    }

    // Singer + Genre
    public function rule5($singer, $genre){

    }

    // View + Feeling
    public function  rule6($view, $feeling){

    }

    // Genre + Feeling
    public  function  rule7($genre, $feeling){

    }

    public function explodeMessage($message){
        $arrMessage = explode(" ", $message);
        return $arrMessage;
    }

    public function convertMessage($message){
        $convertMessage = "('" . implode("', '", $message) . "')";
        return $convertMessage;
    }
}
